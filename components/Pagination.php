<?php

/*
 * Class Pagination to generate pagination
 */

class Pagination
{

    /**
     * 
     * @var Page Navigation Links
     * 
     */
    private $max = 10;

    /**
     * 
     * @var The key for the GET to which the page number is written
     * 
     */
    private $index = 'page';

    /**
     * 
     * @var Current page
     * 
     */
    private $current_page;

    /**
     * 
     * @var Total number of entries
     * 
     */
    private $total;

    /**
     * 
     * @var Page Entries
     * 
     */
    private $limit;

    /**
     * Launch the necessary data for navigation
     * @param type $ total <p> Total number of entries </p>
     * @param type $ currentPage <p> Current page number </p>
     * @param type $ limit <p> Number of records per page </p>
     * @param type $ index <p> Key for url </p>
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        # Set the total number of records
        $this->total = $total;

        # Set the number of records per page
        $this->limit = $limit;

        # Set the key in url
        $this->index = $index;

        # Set the number of pages
        $this->amount = $this->amount();
        
        # Set the current page number
        $this->setCurrentPage($currentPage);
    }

    /**
     * To display links
     * @return HTML with navigation links
     */
    public function get()
    {
        # To record links
        $links = null;

        # Get restrictions for the loop
        $limits = $this->limits();
        
        $html = '<div class="pagination">';
        # To generate links
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # If the current is the current page, there is no link and the active class is added
            if ($page == $this->current_page) {
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                # Otherwise, generate a link
                $links .= $this->generateHtml($page);
            }
        }

        # If links are created
        if (!is_null($links)) {
            # If the current page is not the first
            if ($this->current_page > 1)
            # Create a link to the first
                $links = $this->generateHtml(1, '&lt;') . $links;

            # If the current page is not the first
            if ($this->current_page < $this->amount)
            # Create a link to the "last"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= '<ul>' . $links . '</ul>';

        # Return html
        return $html;
    }

    /**
     * To generate HTML link code
     * @param integer $ page - page number
     *
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # If link text is not specified
        if (!$text)
        # We indicate that the text is a page number
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Generate HTML link code and return
        return
                '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     * To get where to start
     *
     * @return array with beginning and end of reference
     */
    private function limits()
    {
        # Calculate the links on the left (so that the active link is in the middle)
        $left = $this->current_page - round($this->max / 2);
        
        # Calculate the origin
        $start = $left > 0 ? $left : 1;

        # If there is at least $ this-> max pages ahead
        if ($start + $this->max <= $this->amount) {
        # Assign the end of the loop forward to $ this-> max pages or just to a minimum
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # End - Total Pages
            $end = $this->amount;

            # Start - minus $ this-> max from the end
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # Return
        return
                array($start, $end);
    }

    /**
     * To set the current page
     *
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Get the page number
        $this->current_page = $currentPage;

        # If the current page is greater than zero
        if ($this->current_page > 0) {
            # If the current page is less than the total number of pages
            if ($this->current_page > $this->amount)
            # Set the page to the last
                $this->current_page = $this->amount;
        } else
        # Set the page to the first
            $this->current_page = 1;
    }

    /**
     * To get the total number of pages
     *
     * @return page count
     */
    private function amount()
    {
        # Divide and return
        return ceil($this->total / $this->limit);
    }

}
