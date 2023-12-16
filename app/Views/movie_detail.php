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
    <p class="text-[#192553] text-[25px] font-semibold mt-5 mb-5">Tickets on <?= date('Y-m-s'); ?></p>
    <form action="/payment" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="title" value="<?= $movie['title']; ?>">
        <input type="hidden" name="email" value="<?= $email; ?>">
        <div class="mb-3 flex justify-start gap-10">
            <label for="showTime" class="form-label text-[#192553] text-[21px] font-medium">Show Time</label>
            <select name="showTime" class="form-control" id="showTime">
                <?php foreach ($schedule as $s) : ?>
                    <option value=<?= $s['scheduleID']; ?>><?= $s['showtime']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3 flex justify-start gap-7">
            <label for="seats" class="form-label text-[#192553] text-[21px] font-medium">Seat Number</label>
            <select name="seats[]" class="form-control" id="seats" multiple>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="A3">A3</option>
                <option value="A4">A4</option>
                <option value="A5">A5</option>
                <option value="A6">A6</option>
            </select>
        </div>
        <button type="submit" class="mt-8 w-[20%] h-[6vh] bg-[#192553] rounded-[15px] text-white text-[20px] font-medium justify-center items-center">Buy Now</button>
    </form>
</div>

</body>

</HTML>