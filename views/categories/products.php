
<div class="all-categories-products">
<table>
<h1>Categories</h1>

    <tr>
        <th>CategoryId </th>
        <th>ProductId </th>
        <th>ProductName </th>
        <th>Quantity </th>
        <th>Action </th>
    </tr>
    <?php foreach ($this->products as $product): ?>
        <tr>
            <td><?php echo $product[1] ?></td>
            <td><?php echo $product[0] ?></td>
            <td><?php echo $product[2] ?></td>
            <td><?php echo $product[3] ?></td>
            <td><a href="/cart/add/<?= $this->userId[0] ?>/<?= $product[1] ?>/<?= $product[0]?>">Add to cart</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
