<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <a href="/" class="text-black text-[30px] font-medium mb-5">
        <div class="w-[2.5vw] h-[2.5vw] relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-fill" src="/arrow_back.svg" alt="Arrow Back" />
        </div>
    </a>
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
    <p class="text-[#192553] text-[25px] font-semibold mt-5 mb-5">Choose Show Time</p>
    <form action="/choose-seats/<?= $movie['title']; ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="email" value="<?= $email; ?>">
        <div class="mb-3 flex justify-start">
            <div class="w-[2.5vw] h-[2.5vw] relative rounded-[15px] overflow-hidden">
                <img class="w-full h-full object-fill" src="/showtime.svg" alt="Show Time" />
            </div>
            <label for="showTime" class="form-label ml-3 text-[#192553] text-[21px] font-medium items-center justify-center">Show Time</label>
            <select name="showTime" class="form-control ml-10 block px-2 py-1 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="showTime">
                <?php foreach ($schedule as $s) : ?>
                    <option value=<?= $s['scheduleID']; ?>><?= (new DateTime($s['showtime'], new DateTimeZone('UTC')))->format('d F Y (H:i)'); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="mt-8 w-[20%] h-[6vh] bg-[#192553] rounded-[15px] text-white text-[20px] font-medium justify-center items-center">Select Seats</button>
    </form>
</div>

</body>

</HTML>