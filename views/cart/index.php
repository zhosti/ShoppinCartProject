<div class="cart">
<h1><?= htmlspecialchars($this->title) ?></h1>

<table>
    <tr>
        <td>ID</td>
        <td>CartID</td>
        <td>Name</td>
        <td>Price</td>
        <td>Action</td>
    </tr>
    <?php foreach($this->productsCart as $productCart) : ?>
        <tr>

            <td><?= $productCart[0] ?></td>
            <td><?= htmlspecialchars($productCart[1] )?></td>
            <td><?= htmlspecialchars($productCart[2] )?></td>
            <td><?= htmlspecialchars($productCart[3] )?></td>
            <td><a href="cart/delete/<?= $productCart[1] ?>">[Delete]</a></td>
        </tr>
    <?php endforeach ?>
</table>
</div>