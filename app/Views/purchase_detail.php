<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Purchases</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Seat</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ticket as $t) : ?>
                        <tr>
                            <td><?= $t['movieName']; ?></td>
                            <td><?= $t['date']; ?></td>
                            <td><?= $t['time']; ?></td>
                            <td><?= $t['seats']; ?></td>
                            <td><?= $t['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="/" class="btn btn-success">Back</a>
<h1>Hello World</h1>

</body>

</HTML>