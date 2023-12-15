<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <h1 class="text-black text-[30px] font-medium">Now Playing</h1>
    <div class="w-full bg-transparent flex flex-wrap gap-10 mt-3">
        <!-- <?php foreach ($movie as $m) : ?>
            <tr>
                <th scope="row"><?= $m['movieId']; ?></th>
                <td><?= $m['poster']; ?></td>
                <td><?= $m['title']; ?></td>
                <td><?= $m['synopsis']; ?></td>
                <td><a href="/detail/<?= $m['title']; ?>/<?= $email; ?>" class="btn btn-success">Buy</a></td>
            </tr>
        <?php endforeach; ?> -->
        <?php foreach ($movie as $m) : ?>
            <a href="/detail/<?= $m['title']; ?>/<?= $email; ?>" class="w-[26%] h-[49vh] flex flex-col items-center relative">
                <div class="w-full h-[86%] relative rounded-[15px] overflow-hidden">
                    <img class="w-full h-full object-cover" src="/wonka.png" alt=<?= $m['title']; ?> />
                </div>
                <p class="text-[#192553] font-semibold text-[21px]"><?= $m['title']; ?></p>
                <p class="text-[#757687] text-[17px]"><?= $m['genre']; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- <div class="container">
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
<h1>Hello World</h1> -->

</body>

</HTML>