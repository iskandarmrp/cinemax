<div class="container">
    <div class="row">
        <div class="col">
            <h2>Payment</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $movie['title']; ?></h5>
                            <p class="card-text"><?= $movie['synopsis']; ?></p>
                            <p class="card-text"><?= $movie['genre']; ?></p>
                            <p class="card-text"><small class="text-body-secondary"><?= $movie['durationInMins']; ?></small></p>
                            <p class="card-text"><?= $showTime['time']; ?></p>
                            <p class="card-text"><?= implode(', ', $seats); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/purchase" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
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
                <input type="hidden" name="showTime" value="<?= $showTime['showTimeId']; ?>">
                <input type="hidden" name="seats" value="<?= implode(', ', $seats); ?>">

                <button type="submit" class="btn btn-primary">Purchase</button>
            </form>
        </div>
    </div>
</div>