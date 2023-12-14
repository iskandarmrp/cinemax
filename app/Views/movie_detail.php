<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detail Movie</h2>
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
                        </div>
                    </div>
                </div>
            </div>
            <form action="/payment" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="title" value="<?= $movie['title']; ?>">
                <div class="mb-3">
                    <label for="showTime" class="form-label">Show Time</label>
                    <select name="showTime" class="form-control" id="showTime">
                        <option value="12.20">12.20</option>
                        <option value="13.30">13.30</option>
                        <option value="17.70">17.70</option>
                        <option value="12.50">12.50</option>
                        <option value="01.01">01.01</option>
                        <option value="04.50">04.50</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="seats" class="form-label">Seats</label>
                    <select name="seats[]" class="form-control" id="seats" multiple>
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="A3">A3</option>
                        <option value="A4">A4</option>
                        <option value="A5">A5</option>
                        <option value="A6">A6</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Payment</button>
            </form>
        </div>
    </div>
</div>