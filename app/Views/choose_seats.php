<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <a href="/" class="text-black text-[30px] font-medium">Back</a>
    <div class="w-full h-[50vh] flex flex-row relative">
        <div class="w-[30%] h-full relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-cover" src="/wonka.png" alt=<?= $movie['title']; ?> />
        </div>
        <div class="w-[70%] h-full ml-5 flex flex-col">
            <h1 class="text-[#192553] text-[30px] font-semibold"><?= $movie['title']; ?></h1>
            <p class="text-[#757687] text-[20px] font-normal"><?= $movie['genre']; ?></p>
            <div class="flex flex-row">
                <p class="text-[#192553] text-[20px]"><?= $movie['durationInMins']; ?> Minutes</p>
            </div>
            <div class="w-full h-[1px] bg-[#A9AABC] mt-2 mb-2"></div>
            <p class="text-[#192553] text-[20px] font-semibold">Director</p>
            <p class="text-[#192553] text-[18px]"><?= $movie['director']; ?></p>
            <p class="text-[#192553] text-[20px] font-semibold mt-2">Cast</p>
            <p class="text-[#192553] text-[18px]"><?= $movie['director']; ?></p>
            <p class="text-[#192553] text-[20px] font-semibold mt-2">Synopsis</p>
            <p class="text-[#192553] text-[18px]"><?= $movie['synopsis']; ?></p>
        </div>
    </div>
    <p class="text-[#192553] text-[25px] font-semibold mt-5 mb-5">Tickets on <?= $schedule['showtime']; ?></p>
    <form action="/payment" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="title" value="<?= $movie['title']; ?>">
        <input type="hidden" name="email" value="<?= $email; ?>">
        <input type="hidden" name="showTime" value="<?= $schedule['scheduleID']; ?>">
        <div class="mb-3 flex justify-start gap-7">
            <label for="seats" class="form-label text-[#192553] text-[21px] font-medium">Seat Number</label>
            <select name="seats[]" class="form-control" id="seats" multiple>
                <?php foreach ($seats as $s) : ?>
                    <option value=<?= $s; ?>><?= $s; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="mt-8 w-[20%] h-[6vh] bg-[#192553] rounded-[15px] text-white text-[20px] font-medium justify-center items-center">Buy Now</button>
    </form>
</div>

</body>

</HTML>