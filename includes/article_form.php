<!-- This prints out the error message(s) of any non-filled form in the browser -->
<?php if (!empty($article->errors)) : ?>
    <ul>
        <?php foreach ($article->errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST">
    <!-- the value(s) set below are only active for edit_article page, no data is retrieved in a new_article page; 
    even though this form is used for both pages -->
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Article's title" value="<?= htmlspecialchars($article->title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="5" placeholder="Article's content"><?= htmlspecialchars($article->content); ?></textarea>
    </div>

    <div>
        <label for="date_published">Publication date and time</label>
        <input type="datetime-local" name="date_published" id="date_published" value="<?= $article->date_published; ?>">
    </div>

    <button type="submit" name="save">Save</button> <input type="reset" value="Reset">

</form>

