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
                        <tr>
                            <?php foreach ($movie as $m) : ?>
                                <th scope="row">1</th>
                                <td>Ini cover</td>
                                <td><?= $m['title']; ?></td>
                                <td><?= $m['synopsis']; ?></td>
                                <td><a href="/detail/<?= $m['title']; ?>" class="btn btn-success">Buy</a></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <a href="/ticket/create" class="btn btn-primary mb-3">Purchase</a>
    <h1>Hello World</h1>
</body>