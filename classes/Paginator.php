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
    public function __construct($page, $records_per_page, $total_records)
    {
        $this->limit = $records_per_page;

        // filters negation values and strings in the gotten url index
        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => ['default' => 1, 'min_range' => 1]
        ]);

        // ensures the "previous" link is not activated when in the first page, and the reverse
        if ($page > 1){
            $this->previous = $page - 1;
        }
        
        // ensures the "next" link is not activated when in the last page
        $total_pages = ceil($total_records / $records_per_page);

        if ($page < $total_pages){
            $this->next = $page + 1;
        }
        
        // removed the records stored in page(s)
        $this->offset = $records_per_page * ($page - 1);
    }
}




