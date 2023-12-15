<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mt-2">Daftar Movie</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cover</th>
                            <th scope="col">Nama Movie</th>
                            <th scope="col">Sinopsis</th>
                            <th scope="col">Beli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movie as $m) : ?>
                            <tr>
                                <th scope="row"><?= $m['movieId']; ?></th>
                                <td><?= $m['poster']; ?></td>
                                <td><?= $m['title']; ?></td>
                                <td><?= $m['synopsis']; ?></td>
                                <td><a href="/detail/<?= $m['title']; ?>/<?= $email; ?>" class="btn btn-success">Buy</a></td>
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