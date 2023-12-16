<HTML>

<link rel="stylesheet" href="/css/app.css">

<body>
    <div class="bg-gradient-to-b from-[#192553] to-[#BBBEEA] w-full h-full flex items-center justify-center overflow-hidden relative">
        <div class="bg-white w-[40%] h-[66%] rounded-[50px] flex flex-col items-center pt-10 px-10 relative">
            <div class="w-[5vw] h-[4vw] relative overflow-hidden mb-3">
                <img class="w-full h-full object-fill" src="/login.svg" alt="login" />
            </div>
            <h1 class="text-[#020127] font-medium text-[33px]">Welcome to Cinemax!</h1>
            <p class="text-[#020127] font-light text-[25px] mb-5">Fill in your username and password</p>
            <form class="w-full flex flex-col" action="/login_action" method="POST">
                <label for="email" class="text-[#020127] text-[18px] mb-1">Email</label>
                <input type="email" name="email" class="w-full rounded-[15px] border-[1px] border-[#A3A3A3] pl-4 py-2 mb-5" placeholder="Enter your email">
                <label for="password" class="text-[#020127] text-[18px] mb-1">Password</label>
                <input type="password" name="password" class="w-full rounded-[15px] border-[1px] border-[#A3A3A3] pl-4 py-2 mb-9" placeholder="Password">
                <div class="flex items-center justify-center">
                    <button type="submit" class="rounded-[37px] bg-[#192553] w-[40%] h-[6vh] text-white">Log In</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>