<div class="categories">
<h1>Categories</h1>
<form action="/categories/products" method="post">
    <label for="category_num">Enter your choice</label>
    <br />
    <input id="category_num" type="text" name="category_num">
    <br />
    <input id="submit-category" type="submit" value="Find" />
</form>
<ul class="all-categories">
    <?php foreach ($this->categories as $category): ?>
        <li><?= $category[1]?> - <?= $category[0]?></li>
    <?php endforeach; ?>
</ul>
</div>
