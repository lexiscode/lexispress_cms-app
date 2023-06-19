<?php

/**
 * Paginator
 * 
 * Data for selecting a page of records
 */
class Paginator
{
    public $limit;
    public $offset;

    public $previous;
    public $next;

    /**
     * Constructor
     * 
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     */
    public function __construct($page, $records_per_page)
    {
        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => ['default' => 1, 'min_range' => 1]
        ]);

        $this->previous = $page - 1;
        $this->next = $page + 1;

        $this->offset = $records_per_page * ($page - 1);
    }
}




