

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
   
    

    <div id="sidebarSupport" class=""></div>
        <div id="sidebar" class="">

            <div class="sidebar-header">
                <a href="/dashboard"><h3>DashBoard</h3></a>
                <div onclick="sidebarFun()">
                <div class="menuIcon"></div>
                <div class="menuIcon"></div>
                <div class="menuIcon"></div>
            </div>
            </div>

            <ul class="list-unstyled ">
                <li class=@yield('devoters')>
                    <a href="/devoters">Devoters</a>
                </li>
                <li class=@yield('donations')>
                    <a href="/donationlist">Donations</a>
                </li>
                <li class=@yield('expenses')>
                    <a href="/expenses">Expenses</a>
                </li>
                <li class=@yield('users')>
                    <a href="/users">User Management</a>
                </li>
            </ul>
            <button class="logoutBtn" id="logoutBtn" onclick="displayLogout('logout')">Logout</button>
        </div>

        <div class="logoutMsgWrapper" id="logoutMsgWrapper">
            <div class="conformMsg">
                <p>Are you Sure ?</p>
                <div class="conformMsgBtnsDiv">     
                   <a href="/logout-user" style="width: auto"><button class="btn btn-success logout" type="submit">Logout</button></a> 
                   <div class="btn btn-danger cancelBtn"  onclick="displayLogout('cancel')">Cancel</div>
                </div>
            </div>
        </div>
       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script>
    function sidebarFun(){
        let sidebar = document.getElementById('sidebar');
        let sidebarSupport = document.getElementById('sidebarSupport');
        let logoutBtn = document.getElementById('logoutBtn');

        if(sidebar.className=="openSidebar"){
            sidebarSupport.className="";
            sidebar.className="";
            logoutBtn.style.display="";

    }else{
        sidebarSupport.className="sidebarSupport";
        sidebar.className="openSidebar";
        logoutBtn.style.display="none";
    }
    }

    function displayLogout(value){
            let logoutMsg = document.getElementById('logoutMsgWrapper');
            
            if(value == 'logout' ){
                logoutMsg.style.display="flex";
            }
            else{
                logoutMsg.style.display="none";
            }
        }
</script>
</body>
</html>
