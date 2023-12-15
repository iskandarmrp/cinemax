<HTML>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="/css/app.css">

<!-- <header>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="/public/css/style.css">
</header> -->

<body class="w-full min-h-screen relative flex flex-row overflow-hidden">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    <div class="flex flex-col w-[20%] h-[100vh] bg-[#192553] text-white py-7 items-center fixed">
        <h1 class="text-[30px] font-medium">Cinemax</h1>
        <div class="w-[12vw] h-[12vw] relative rounded-[15px] overflow-hidden">
            <img class="w-full h-full object-fill" src="/profile.svg" alt="Profile" />
        </div>
        <p class="mt-4 text-[16px] font-medium"><?= $email; ?></p>

        <p class="mt-2 text-[18px]">Buyer</p>

        <a href="/<?= $email; ?>" class="w-[80%] bg-[#ECEEFF] h-[8%] rounded-[15px] flex items-center justify-center mt-20">
            <p class="text-[#020127] text-[21px]">Movies</p>
        </a>
        <a href="/purchases/<?= $email; ?>" class="w-[80%] h-[8%] rounded-[15px] flex items-center justify-center mt-5">
            <p class="text-[21px] text-white">Purchases</p>
        </a>
        <a href="/logout" class="w-[80%] h-[8%] rounded-[15px] flex items-center justify-center absolute bottom-4">
            <p class="text-[21px] text-[#E73434]">Logout</p>
        </a>
    </div>