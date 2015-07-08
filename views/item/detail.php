<?php if (sizeof($items) > 0): ?>
<b>Products:</b>
<div class="col-md-12">
    <table class="table table-bordered items-table">
        <thead>
            <tr>
                <th>
                    Options
                    <input type="hidden" id="items-amount" name="items-amount" value="1">
                </th>
                <th>
                    Description
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Price
                </th>
            </tr>
        </thead>
        <tbody id="items-body">
            <?php foreach ($items as $item): ?>
            <tr class="item">
                <td class="col-md-1">
                    <span class="glyphicon glyphicon-trash"></span>
                </td>
                <td class="col-md-5 form-group">                        
                    <input type="text" class="form-control item-name" placeholder="Name" value="<?= $item->name ?>" disabled><br>                        
                    <textarea class="form-control item-description" placeholder="Description" disabled><?= $item->description ?></textarea><br>                        
                    <textarea class="form-control item-data" placeholder="Technical data" disabled><?= $item->data ?></textarea><br>                
                </td>
                <td class="col-md-3 form-group">                        
                    <input type="text" class="form-control item-amount" placeholder="Amount" value="<?= $item->amount ?>" disabled><br>
                </td>
                <td class="col-md-3 form-group">

                    <input type="text" class="form-control item-price" placeholder="Price" value="<?= $item->price ?>" disabled><br>

                    <input type="text" class="form-control item-discount" placeholder="Discount" value="<?= $item->discount ?>" disabled><br>

                    <input type="readonly" class="form-control item-final" placeholder="Final price" value="<?= $item->final ?>" disabled>                
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>  
<?php endif ?>