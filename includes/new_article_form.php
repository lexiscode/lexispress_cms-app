<?php if (!empty($error)): ?>
    <p>* <i><?= $error ?></i></p>
<?php endif; ?>

<form method="POST">
    <!-- the value(s) set below are only active for edit_article page, no data is retrieved in a new_article page; 
    even though this form is used for both pages -->
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Article's title" value="<?= htmlspecialchars($article->title); ?>" required>
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="5" placeholder="Article's content"></textarea>
    </div>

    <div>
        <label for="date_published">Publication date and time</label>
        <input type="datetime-local" name="date_published" id="date_published" value="<?= $article->date_published; ?>">
    </div>

    <fieldset>
        <legend>Categories</legend>

        <?php foreach($categories as $category): ?>
            <div>
                <input type="checkbox" name="category[]" value="<?= $category['id']?>" id="category<?= $category['id']?>" 
                <?php if (in_array($category['id'], $category_ids)) :?>checked<?php endif;?> >

                <label for="category<?= $category['id']?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach; ?>

    </fieldset>

    <button type="submit" name="save">Save</button> <input type="reset" value="Reset">

</form>
