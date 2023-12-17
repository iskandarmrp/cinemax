<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <h1 class="text-black text-[30px] font-medium">Now Playing</h1>
    <div class="w-full bg-transparent flex flex-wrap gap-x-16 gap-y-10 mt-3">
        <?php foreach ($movie as $m) : ?>
            <a href="/detail/<?= $m['title']; ?>" class="w-[26%] h-[49vh] flex flex-col items-center relative">
                <div class="w-full h-[86%] relative rounded-[15px] overflow-hidden">
                    <img class="w-full h-full object-cover" src="/<?= $m['posterImg']; ?>" alt=<?= $m['title']; ?> />
                </div>
                <p class="text-[#192553] font-semibold text-[21px]"><?= $m['title']; ?></p>
                <p class="text-[#757687] text-[17px]"><?= $m['genre']; ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>

</body>

</HTML>