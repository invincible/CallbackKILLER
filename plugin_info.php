<div class="wrap">
    <h2>Информация о плагине CallbackKILLER</h2>

    <div>
        <p><strong>Автор: </strong> Печенов Сергей </p>
        <p><strong>Дата создания: </strong> 10 февраля 2016 г.</p>
        <p><strong>Мой email:</strong> <a href="mailto:pe4enov@gmail.com">pe4enov@gmail.com</a></p>
        <p><strong>Сайт:</strong> <a href="http://pechenov.livejournal.com/">pechenov.livejournal.com</a></p>
    </div>

    <form action="admin.php?page=cbkiller_plugin_info&action=submit" method="POST">
        <label for="site_id">ID сайта:</label>
        <input type="text" name="site_id" id="site_id" value="<?php echo get_option('cbkiller_site_id'); ?>" />
        <input type="submit" class="button" name="send" value="Сохранить" />
    </form>

</div>