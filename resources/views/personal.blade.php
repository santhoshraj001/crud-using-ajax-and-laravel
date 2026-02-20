<!DOCTYPE html>
<head>
    <title>Personal Detail Form</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <script src="https://cdn.tailwindcss.com"></script>

     
</head>
<body>
<div class="text-midgrey p-4 rounded 
w-[650px] items-center justify-center mx-auto font-cera-regular">
<h1 class="mt-4 font-cera-medium text-4xl font-normal text-midgrey leading-1.222 md:text-4.5xl md:leading-1.2">Tell us about you</h1>
<!-- <h1 class="font-cera-medium font-normal text-4xl
 leading-1.222 md:text-4.5xl md:leading-1.2 text-midgrey
  hidden md:block"
 aria-disabled="false"> Tell us about who </h1> -->
<p class="mt-2 text-base font-cera-regular text-midgrey">Please provide your personal details below. This information will help us to know you better and tailor our services to your needs and thanks for contact us.</p>
<p id="msg" class="mt-2 text-midgrey"></p>

<form action="{{ route('personal.index') }}" id="personalform" method="POST" >
    @csrf 
    
    <input type="hidden" name="id" id="studentid">
    <div class="grid items-center gap-2 mt-6">
    <label for="name" class="font-bold text-sm/4  text-midgrey">Name :</label>
    <input type="text" id="name" placeholder="Enter full name" class="w-[630px] border border-midgrey text-gray-500 
    placeholder-midgrey-light-48 p-2" name="name" required >
    </div>
    <br>
    <div class="grid items-center gap-2">
    <label for="email" class="font-bold text-sm/4 ">Email :</label>
    <input type="text" id="email" placeholder="Enter your email" class="placeholder-midgrey-light-48 w-[630px] border border-midgrey text-gray-500 p-2" name="email" required>
     </div>
    <br>
    <div class="grid items-center gap-2">
    <label for="contact" class="font-bold text-sm/4 ">Contact :</label>
    <input type="number" id="contact" placeholder="Enter your contact number" class="placeholder-midgrey-light-48 w-[630px] border border-midgrey text-gray-500 p-2" name="contact" required>
    </div>
    <br>
    <div class="grid items-center gap-2">
    <label for="place" class="font-bold text-sm/4 ">Place :</label>
    <select id="place" name="place" class="w-[630px] h-[42px] border border-midgrey" required>
        <option value="">Select</option>
        <option value="New York">New York</option>
        <option value="madurai">Madurai</option>
        <option value="Chennai">Chennai</option>
        <option value="kumbakonam">Kumbakonam</option>
        <option value="villupuram">Villupuram</option>
    </select>
    </div>
    <br>
    <div class="items-center gap-2">
    <label for="gender" class="mb-2 block text-sm/4 font-bold ">Gender :</label>
    <label class=" flex items-center mt-1 gap-3 text-base ">
    <input type="radio" id="male" class="w-[24px] h-[24px] accent-gray-500 " name="gender" value="male" required>Male
    </label>
    <label class=" flex items-center gap-3 text-base mt-2">
    <input type="radio" id="female" class="w-[24px] h-[24px] accent-gray-500 " name="gender" value="female" required>Female
    </label>
    </div>
    <br>
    <div class="flex items-center gap-2 my-2">
    <label for="skills" class="font-bold text-sm/4">Skills :</label>
    <input type="checkbox" id="html" class="ml-[35px]" name="skills" value="html">Html
    <input type="checkbox" id="css" name="skills" value="css">Css
    <input type="checkbox" id="js" name="skills" value="js">Js
    <input type="checkbox" id="php" name="skills" value="php">php
    </div>
    <br>
    <button type="button" class="border-1 bg-gray-50 border-stone-900 rounded my-[10px] p-2" onclick="savedata()">Submit</button>
    <button type="button" id="one" class="border-1 bg-gray-50 border-stone-900 rounded my-[10px] p-2" style="display: none;" onclick="updateStudent()">Update</button>
    <button type="button" id="two" class="border-1 bg-gray-50 border-stone-900 rounded my-[10px] p-2" style="display: none;" onclick="cancelupdate()">Cancel Update</button>
    <button type="button" id="three" class="border-1 bg-gray-50 border-stone-900 rounded my-[10px] p-2" style="margin-left: 5%;" onclick="Deleteselected()">Delete selected</button>
    <button type="button" id="four" class="border-1 bg-gray-50 border-stone-900 rounded my-[10px] p-2" style="margin-left: 5%;" onclick="resetbut()">Reset</button>

</div>
<table border="1" class="my-4 ml-[18%] border-2 border-gray-950 w-fit p-4 rounded-md">
    <thead class="bg-gray-300">
        <tr>
            <th class="border p-2">select</th>
            <th class="border p-2">ID</th>
            <th class="border p-2">Name</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Contact</th>
            <th class="border p-2">Place</th>
            <th class="border p-2">Gender</th>
            <th class="border p-2">Skills</th>
            <th class="border p-2">Edit</th>
            <th class="border p-2">Delete</th>
        </tr>
    </thead>
    <tbody id="studenttable" class="border border-gray-950 p-2">
      
    
   </tbody>
</table>
</form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
    function savedata(){
        $.ajax({                              //Send data to the server without reloading the page
            type: "POST",
            url: "{{ route('personal.store') }}",   //AJAX sends data to this route and Controller store() receives it

            data: {
                name: $('#name').val(),
                email: $('#email').val(),  //its for getting value from email input field
                contact: $('#contact').val(),
                place: $('#place').val(),
                gender: $('input[name="gender"]:checked').val(), //its for getting radio button value
                skills: $('input[name="skills"]:checked').map(function(){return this.value;}).get(), //its for getting multiple checkbox values
                _token: '{{ csrf_token() }}'        //its for csrf token 
            },
            success: function(response) {
                // $('#msg').text('Data saved successfully!');
                document.getElementById('msg').innerText = response.message;
                $('#personalform')[0].reset();    //its for reset the form after successfull submission
                loadtable(); // Reload the table data after successful submission
            },
            error: function(xhr) {
                $('#msg').text('An error occurred while saving data.👎');
            }
        });
       

    }
        
            function loadtable(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('personal.fetchdata') }}",   //AJAX sends data to this route and Controller fetchdata() receives it
                    success: function(response) {
                        let tbody = '';
                        response.data.forEach(function(detail) {
                            tbody += `
                                <tr>
                                    <td class="border p-2 pl-2"><input type="checkbox" class="selectbox" value="${detail.id}"></td>
                                    <td class="border p-2">${detail.id}</td>
                                    <td class="border p-2">${detail.name}</td>
                                    <td class="border p-2">${detail.email}</td>
                                    <td class="border p-2">${detail.contact}</td>
                                    <td class="border p-2">${detail.place}</td>
                                    <td class="border p-2">${detail.gender}</td>
                                    <td class="border p-2">${detail.skills}</td>
                                    <td class="border p-2"><button type="button" onclick="editdata(${detail.id})">Edit</button></td>
                                    <td class="border p-2"><button type="button" onclick="deletedata(${detail.id})">Delete</button></td>
                                </tr>`;
                        });
                        $('#studenttable').html(tbody);
                    }
                });
                
            } 
            loadtable(); // Load table data on page load  

       function editdata(id) {
    $.ajax({
        
        url: "{{ url('/personal/edit') }}/" + id,
      

        type: "GET",
        success: function(response) {
            let data = response.data; // 👈 IMPORTANT LINE TO GET THE JSON RESPONCE
            $('#studentid').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#contact').val(data.contact);
            $('#place').val(data.place);
            $('input[name="gender"][value="' + data.gender + '"]').prop('checked', true);
            // checkbox
    let skills = data.skills.split(',');
    skills.forEach(skill => {
        $('input[name="skills"][value="' + skill + '"]').prop('checked', true);
    });
        }
    });
    $('#two').show();  // show cancel button
    $('#one').show();  // show update button i'm using this for showing update button when we click edit button

}

    function updateStudent() {
    $.ajax({
        
        url: "{{ route('personal.update', ':id') }}".replace(':id', $('#studentid').val()),

        type: "POST",
        data: {
            // id: $('#studentid').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            contact: $('#contact').val(),
            place: $('#place').val(),
            gender: $('input[name="gender"]:checked').val(),
            skills: $('input[name="skills"]:checked').map(function(){return this.value;}).get(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#msg').text('Data updated successfully! 👍');
            // alert(response.message);

            loadtable();   // refresh table

            $('#personalform')[0].reset(); // reset form
        }
    });
    $('#two').hide();
    $('#one').hide(); // hide update and cancel buttons
}
function deletedata(id) {

    $.ajax({
        
        url: "{{ url('/personal/delete') }}/" + id,
        type: "GET",
        success: function(response) {
            $('#msg').text('Data deleted successfully! 👍');
            loadtable(); // refresh table
        }
    });
}
function Deleteselected() {
    let selectedIds = [];
    $('.selectbox:checked').each(function() {
        selectedIds.push($(this).val());
    });

    // if(selectedIds.length === 0) {
    //     alert('Please select at least one record to delete.');
    //     return;
    // }

    $.ajax({
        url: "{{ route('personal.deleteselected') }}",
        type: "POST",
        data: {
            ids: selectedIds,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#msg').text('Selected records deleted successfully! 👍');
            loadtable(); // refresh table
        }
    });
}
 function cancelupdate() {
        $('#personalform')[0].reset(); // reset form
        $('#two').hide();
        $('#one').hide(); // hide update and cancel buttons
    }
function resetbut() {
        $('#personalform')[0].reset(); // reset form
        $('#msg').text('');
    }

</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

