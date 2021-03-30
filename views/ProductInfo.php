<div class="product" style="padding-top: 50px; padding-left: 30%;">
    <p><?= $product->getName();?>:</p>
    <div class="products-table">
        <table border="1" cellspacing="0" cellpadding="15" width="50%">
        <tr>
            <td><img alt src="<?= $product->getImage();?>" width="400" height="400"></td>
        </tr>
        <tr>
            <td>Пользователь: <?= $product->getUserName();?></td>
        </tr>
        <tr>
            <td>Средняя оценка: <?=$review_avg;?>/10</td>
        </tr>
        <tr>
            <td>Дата добавления: <?= $product->getCreationDate();?></td>
        </tr>
        </table>
    </div>
</div>
<div class="reviews">
    </br></br>
    <b>Добавить комментарий:</b>
    <form action="/review/add" method="post" enctype="multipart/form-data">
        <input type="text" name="user_name">Имя пользователя</br>
        <input type="text" name="message">Комментарий</br>
        Оценка:
        <select name="rate">
            <?php for($i = 1; $i<=10; $i++):?>
            <option value="<?=$i;?>"><?=$i;?></option>
            <?php endfor;?>
        </select><br/>
        <input type="text" name="product_id" value="<?=$product->getId();?>" hidden>
        <button type="submit">Отправить</button>
    </form>
    <h3>Отзывы:</h3>
    <table>
        <?php foreach ($reviews as $review):?>
        <tr>
            <td>
                <hr/>
                <b><?=$review->getUserName();?></b>
                <ul>
                    <li><b>Сообщение:</b> <?=$review->getMessage();?></li>
                    <li><b>Оценка:</b> <?=$review->getRate();?>/10</li>
                    <li><b>Дата:</b> <?=$review->getCreationDate();?></li>
                </ul>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
