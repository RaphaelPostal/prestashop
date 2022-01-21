<div class="tab-pane" id="Fournisseur">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom du fournisseur</th>
            <th scope="col">Email du fournisseur</th>
            <th scope="col">Produit</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            {foreach from=$suppliers item=supplier}
                <td>{$supplier->name}</td>
                <td>{$supplier->email}</td>
            {/foreach}
            {foreach from=$products item=product}
                <td>{$product.product_name}</td>
            {/foreach}
        </tr>
        </tbody>
    </table>

</div>