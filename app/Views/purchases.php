<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mt-2">Daftar Purchases</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Price</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payment as $p) : ?>
                            <tr>
                                <td><?= $p['paymentDate']; ?></td>
                                <td><?= $p['totalPrice']; ?></td>
                                <td><?= $p['paymentMethod']; ?></td>
                                <td><a href="/purchase/<?= $p['paymentId']; ?>" class="btn btn-success">Detail</a></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="/purchases" class="btn btn-success">Purchases</a>
    <h1>Hello World</h1>
</body>