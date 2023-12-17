<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <a href="/detail/<?= $movie['title']; ?>" class="text-black text-[30px] font-medium mb-5">
        <div class="w-[2.5vw] h-[2.5vw] relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-fill" src="/arrow_back.svg" alt="Arrow Back" />
        </div>
    </a>
    <div class="w-full h-[50vh] flex flex-row relative">
        <div class="w-[30%] h-full relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-cover" src="/<?= $movie['posterImg']; ?>" alt=<?= $movie['title']; ?> />
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
    <p class="text-[#192553] text-[25px] font-semibold mt-5 mb-5">Tickets on <?= (new DateTime($schedule['showtime'], new DateTimeZone('UTC')))->format('d F Y (H:i)'); ?></p>
    <form action="/payment" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="title" value="<?= $movie['title']; ?>">
        <input type="hidden" name="email" value="<?= $email; ?>">
        <input type="hidden" name="showTime" value="<?= $schedule['scheduleID']; ?>">
        <div class="flex justify-start">
            <div class="w-[2.5vw] h-[2.5vw] relative rounded-[15px] overflow-hidden">
                <img class="w-full h-full object-fill" src="/seatnumber.svg" alt="Seat Number" />
            </div>
            <label for="seats" class="form-label ml-3 text-[#192553] text-[21px] font-medium">Seat Number</label>
            <!-- <select name="seats[]" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[5%] p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="seats" multiple>
                <?php foreach ($seats as $s) : ?>
                    <option value=<?= $s; ?>><?= $s; ?></option>
                <?php endforeach; ?>
            </select> -->
            <ul class="max-h-[170px] max-w-[25%] ml-8 bg-[#A9AABC] px-3 py-2 rounded-[25px] overflow-y-auto text-sm text-gray-700 dark:text-gray-200 flex flex-wrap">
                <?php foreach ($seats as $s) : ?>
                    <li class="w-10 h-10 relative">
                        <div class="w-full h-full flex items-center rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <input id="seats-<?= $s; ?>" name="seats[]" type="checkbox" value="<?= $s; ?>" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="seats-<?= $s; ?>" class="w-full ml-1 text-sm font-medium text-gray-900 rounded dark:text-gray-300"><?= $s; ?></label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button type="submit" class="mt-4 w-[20%] h-[6vh] bg-[#192553] rounded-[15px] text-white text-[20px] font-medium justify-center items-center">Buy Now</button>
    </form>
</div>

</body>

</HTML>