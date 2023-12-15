<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <a href="/detail/<?= $movie['title']; ?>/<?= $email; ?>" class="text-black text-[30px] font-medium">Back</a>
    <h1 class="text-[#192553] text-[35px] font-medium">Order Summary</h1>
    <div class="w-full h-[35vh] flex flex-row relative">
        <div class="w-[20%] h-full relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-cover" src="/wonka.png" alt=<?= $movie['title']; ?> />
        </div>
        <div class="w-[70%] h-full ml-5 flex flex-col">
            <h1 class="text-[#192553] text-[30px] font-semibold"><?= $movie['title']; ?></h1>
            <p class="text-[#757687] text-[20px] font-normal"><?= $movie['genre']; ?></p>
            <div class="flex flex-row mt-5 mb-5">
                <p class="text-[#192553] text-[20px]"><?= $movie['durationInMins']; ?> Minutes</p>
            </div>
            <p class="text-[#192553] text-[20px] font-medium"><?= $showTime['showtime']; ?></p>
            <p class="text-[#192553] text-[20px] font-medium mt-2"><?= $showTime['showtime']; ?></p>
        </div>
    </div>
    <p class="text-[#192553] font-medium text-[30px] mt-2">Transaction Details</p>
    <div class="flex flex-row justify-between">
        <p class="text-[#192553] text-[20px] font-medium">Tickets</p>
        <p class="text-[#192553] text-[20px] font-medium"><?= implode(', ', $seats); ?></p>
    </div>
    <div class="flex flex-row justify-between">
        <p class="text-[#192553] text-[20px] font-medium">Cinemax Seats</p>
        <div class="flex flex-row">
            <p class="text-[#192553] text-[20px] font-normal">Rp <?= number_format($showTime['price'], 2); ?> x <?= $count; ?> = </p>
            <p class="text-[#192553] text-[20px] font-medium ml-1">Rp <?= number_format($count * $showTime['price'], 2); ?></p>
        </div>
    </div>
    <div class="w-full flex flex-row-reverse">
        <p class="text-[#192553] text-[25px] font-semibold">Total Bill: Rp <?= number_format($count * $showTime['price'], 2); ?></p>
    </div>
    <p class="text-[#192553] font-medium text-[30px] mt-2">Payment Method</p>
    <form action="/purchase" method="post">
        <?= csrf_field(); ?>
        <div class="mt-2">
            <select name="paymentMethod" class="form-control" id="paymentMethod">
                <option value="gopay">GoPay</option>
                <option value="ovo">OVO</option>
                <option value="bca">BCA</option>
                <option value="dana">DANA</option>
                <option value="bni">BNI</option>
                <option value="bri">BRI</option>
            </select>
        </div>
        <input type="hidden" name="email" value="<?= $email; ?>">
        <input type="hidden" name="title" value="<?= $movie['title']; ?>">
        <input type="hidden" name="showTime" value="<?= $showTime['scheduleID']; ?>">
        <input type="hidden" name="seats" value="<?= implode(', ', $seats); ?>">

        <button type="submit" class="mt-5 w-[20%] h-[6vh] bg-[#192553] rounded-[15px] text-white text-[20px] font-medium justify-center items-center">Pay Now</button>
    </form>
</div>

</body>

</HTML>