<ul class="all-categories">
    <p>Products:</p>

<table >

    <th>ID</th>
    <th>ProductName</th>
    <th>Quantity</th>
    <th>Price</th>

    <?php foreach ($this->products as $product): ?>
        <tr>
            <td><?= $product[0]?></td>
            <td><?= $product[3]?></td>
            <td><?= $product[2]?></td>
            <td><?= $product[1]?></td>
            <td><a href="/cart/add/<?= $this->userId[0] ?>/<?= $product[1] ?>/<?= $product[0]?>">[Add to cart]</a></td>
        </tr>
    <?php endforeach; ?>
</table>
</ul>