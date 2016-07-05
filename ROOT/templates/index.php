<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>hi</title>
    </head>
    <body>
        <table>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    NAME
                </th>
            </tr>
            <?php foreach($data->get('rows') as $row): ?>
            <tr>
                <td>
                    <?=$row->id?>
                </td>
                <td>
                    <?=$row->name?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
