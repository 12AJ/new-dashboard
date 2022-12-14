<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/user-management.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>User Management</title>
</head>
<body>
    <div class="adjustSidebar">

        <header>
            @section('users')
            "active"
            @endsection
            @include('layouts/sidebar')
        </header>
        <main>
            @section('heading')
            User Management
            @endsection
            @include('layouts/navbar')

            <div class="addUserBtnWrapper">
                <a href="/addusers"><button class="btn btn-success">Add User</button></a>
            </div>
            <div class="tableDiv">
                <table>
                    <tr>
                        <th width="80px">Serial no.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="150px">Mobile</th>
                        <th width="120px">Action</th>
                    </tr>
    
                    @php
                        $Serialno = 1;
                    @endphp
    
                    @if ($userList != null)
                    @foreach ($userList as $id=>$item)
                    <tr>
                        <td>
                           {{$Serialno++;}}
                        </td>
                        <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['mobile']}}</td>
                        <td>

                            <div class="btn editBtn" onclick="userFun('edit', '{{$id}}')"><i class="fa fa-edit"></i></div>
                            
                            <div class="btn deleteBtn" onclick="userFun('delete', '{{$id}}')"><i class="fa fa-trash"></i></div>
                           
                        </td>
                    </tr>
                    @endforeach
                    @else
                      <tr ><td colspan="6" style="text-align: center;font-size: 20px">
                            No Data to show
                        </td> </tr> 
                    @endif
                    </table>
                        </div>


                    <div class="deleteWrapper" id="deleteWrapper">
                        <div class="conformMsg" >
                            <p>Enter Admin Password</p>
                            <form action="" method="POST" id="deleteForm">
                                @csrf
                                <input type="password" class="form-control" name="adminPassword" id="exampleInputPassword1" required placeholder="Admin Password">
                                <div class="conformMsgBtnsDiv">    
                                    <button class="btn btn-success" type="submit">Delete the User</button>
                                   <button class="btn btn-danger cancelBtn"  type="reset" onclick="userFun('cancel')">Cancel</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                    <div class="editWrapper" id="editWrapper">
                        <div class="conformMsg">
                            <p>Enter Admin Password</p>
                             
                            <form action="" method="POST" id="editForm">
                                @csrf
                                <input type="password" class="form-control" name="adminPassword" id="exampleInputPassword1" required placeholder="Admin Password">
                                <div class="conformMsgBtnsDiv">     
                                    <button class="btn btn-success" type="submit">Edit the User</button>
                                   <button class="btn btn-danger cancelBtn" type="reset" onclick="userFun('cancel')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
    
        </main>

    </div>
   
    @if (session()->has('adminDeleteFail'))
    <script defer>
        alert("Admin Password is incorrect !! Failed To Delete User !")
    </script>
    @endif

    @if (session()->has('adminpasswordfail'))
    <script defer>
        alert("Admin Password is incorrect !! Failed To Edit User !")
    </script>
    @endif

    @if (session()->has('deletesuccess'))
    <script defer>
        alert("User Deleted Successfully")
    </script>
    @endif

    @if (session()->has('deletefail'))
    <script defer>
        alert(" Failed To Delete User ! please try later")
    </script>
    @endif
    @if (session()->has('updatesuccess'))
    <script defer>
        alert(" User Updated Successfully")
    </script>
    @endif
    @if (session()->has('updatefail'))
    <script defer>
        alert(" Failed To Update User ! please try later")
    </script>
    @endif
    
    <script>


        function userFun(value ,id){
            
            let deleteWrapper = document.getElementById('deleteWrapper');
            let editWrapper = document.getElementById('editWrapper');
            let editForm = document.getElementById('editForm');
            let deleteForm = document.getElementById('deleteForm');

            if(value=='edit'){
                editWrapper.style.display="flex";
                deleteWrapper.style.display="none";
                editForm.action=`/update-user/${id}`;
            }else if(value=='delete'){
                deleteWrapper.style.display="flex";
                editWrapper.style.display="none"
                deleteForm.action=`/delete-user/${id}`
            }else{
                deleteWrapper.style.display="none";
                editWrapper.style.display="none"
            }
        }
    </script>
   </body>
</html>