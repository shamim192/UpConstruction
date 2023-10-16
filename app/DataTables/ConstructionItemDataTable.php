<?php

namespace App\DataTables;

use App\Models\ConstructionItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConstructionItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('image',function($query){
           return '<img style="width:70px" src="'.asset($query->image).'"> </img>';
        })
        ->addColumn('created_at', function($query){
            return date('d-m-Y', strtotime($query->created_at));
        })

        ->addColumn('action', function($query){
            return '<a href="'.route('admin.construction-item.edit',$query->id).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
            <a href="'.route('admin.construction-item.destroy', $query->id).'" class="btn btn-danger delete-item"><i class="fas fa-trash"></i></a>';
        })
        ->rawColumns(['image','action'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ConstructionItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('constructionitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(100),
            Column::make('image')->width(100),
            Column::make('title'),           
            Column::make('created_at'),            
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ConstructionItem_' . date('YmdHis');
    }
}