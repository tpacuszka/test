<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Quote;

class QuoteModel extends Model
{   
    /**
     * Generates pdf layout of quote
     * @param Quote $model
     * @return string
     */
    public function generatePdfLayout($model) 
    {   
        $i = 1;
        $items = $model->getItems()->all();
        $head = '
            <html><head>
                <meta charset="UTF-8">    
                <link href="/assets/db463288/css/bootstrap.css" rel="stylesheet">
                <link href="/css/site.css" rel="stylesheet"><style type="text/css"></style>
            </head>
            ';
        $style = ' 
            <style>
                .header {
                        text-align: center;
                        font-size: x-large;
                      }
                .welcome {
                        margin-left: 15%;
                        font-size: large;
                      }
                .entry {
                        margin-left: 10%;
                      }
            </style>
                ';
        $body = ' 
            <body>'.$style.'
                <div class="container"><div class="row">
                <h1 class="header">Quote no. '.$model->id.' </h1>
                <br>                
                <p class="welcome">Welcome</p>
                <p class="entry"> &nbsp;&nbsp;&nbsp;&nbsp;'.$model->header.'</p>                
                </div>               
            ';
        $itemsTable = '<table class="table table-bordered">
                    <thead>
                      <tr>
                        <td>
                            #
                        </td>
                        <td>
                            Description
                        </td>
                        <td>
                            Amount
                        </td>
                        <td>
                            Price
                        </td>
                      </tr>
                    </thead>
                    <tbody>';
        foreach ($items as $item) {
            $itemsTable .= '<tr>
                        <td>
                            '.$i.'
                        </td>
                        <td>
                            '.$item->name.'
                        </td>
                        <td>
                            '.$item->amount.'
                        </td>
                        <td>
                            '.$item->price.'
                        </td>
                      </tr>';
        }
                      
        $itemsTable .= '</tbody></table>';
        $body .= $itemsTable;
        $body .= '</div> </body></html>';
        $page = $head.$body;
        
        return $page;
                
    }
}