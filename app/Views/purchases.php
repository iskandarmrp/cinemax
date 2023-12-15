<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <p class="text-[#192553] text-[30px] font-medium">My Purchases</p>
    <div class="w-full bg-transparent flex flex-col gap-4 mt-3 mb-5">
        <?php foreach ($payment as $p) : ?>
            <a href="/purchase/<?= $email; ?>/<?= $p['paymentId']; ?>" class="w-full h-[25vh] flex flex-col relative overflow-hidden rounded-[15px] border-[1px] border-[#020127]">
                <div class="w-full h-[5vh] relative bg-[#192553] flex flex-col justify-center">
                    <p class="text-white font-semibold text-[17px] ml-5"><?= $p['paymentDate']; ?></p>
                </div>
                <div class="w-full h-[20vh] relative flex flex-row px-5 py-2 justify-between">
                    <div class="flex flex-col gap-0.5">
                        <p class="text-[#757687] font-medium text-[15px]">Order ID #<?= $p['paymentId']; ?></p>
                        <p class="text-black font-semibold text-[17px]"><?= $p['movieName']; ?></p>
                        <p class="text-[#192553] font-medium text-[15px]"><?= count(json_decode($p['seats'])); ?> Tickets: <?= implode(', ', json_decode($p['seats'])); ?></p>
                        <p class="text-[#192553] font-medium text-[15px]"><?= $p['showtime']; ?></p>
                        <div class="flex flex-row">
                            <p class="text-[#228420] font-medium text-[16px]">Payment Confirmed</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center">
                        <div class="h-[80%] w-[1px] bg-[#757687]"></div>
                        <div class="flex flex-col ml-5">
                            <p class="text-[#757687] text-[16px]">Total Price</p>
                            <p class="text-[#020127] font-semibold text-[22px]">Rp. <?= number_format($p['totalPrice'], 2); ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

</body>

</HTML>