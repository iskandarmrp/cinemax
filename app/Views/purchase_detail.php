<div class="w-full bg-white py-7 pl-[24vw] pr-[4vw] flex flex-col">
    <a href="/purchases" class="text-[#192553] text-[30px] font-medium mb-2">
        <div class="w-[2.5vw] h-[2.5vw] relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-fill" src="/arrow_back.svg" alt="Arrow Back" />
        </div>
    </a>
    <p class="text-[#192553] text-[30px] font-medium">Payment Detail</p>
    <div class="w-full bg-transparent flex flex-col gap-4 mt-3 mb-5">
        <?php foreach ($ticket as $t) : ?>
            <div class="w-full h-[25vh] flex flex-col relative overflow-hidden rounded-[15px] border-[1px] border-[#020127]">
                <div class="w-full h-[5vh] relative bg-[#192553] flex flex-col justify-center">
                    <p class="text-white font-semibold text-[17px] ml-5">Ticket Detail</p>
                </div>
                <div class="w-full h-[20vh] relative flex flex-col gap-2 px-5 py-2">
                    <p class="text-black font-semibold text-[17px]"><?= $t['movieName']; ?></p>
                    <p class="text-[#192553] font-medium text-[15px]"><?= (new DateTime($t['time'], new DateTimeZone('UTC')))->format('d F Y (H:i)'); ?></p>
                    <p class="text-[#192553] font-medium text-[15px]">Seat: <?= $t['seats']; ?></p>
                    <p class="text-[#020127] font-semibold text-[18px]">Rp. <?= number_format($t['price'], 2); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Purchases</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Seat</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ticket as $t) : ?>
                        <tr>
                            <td><?= $t['movieName']; ?></td>
                            <td><?= $t['date']; ?></td>
                            <td><?= $t['time']; ?></td>
                            <td><?= $t['seats']; ?></td>
                            <td><?= $t['price']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="/" class="btn btn-success">Back</a>
<h1>Hello World</h1> -->

</body>

</HTML>