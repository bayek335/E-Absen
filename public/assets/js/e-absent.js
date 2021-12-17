// global function
onDeleteButton = (e, id, token, url) => {
    e.preventDefault();
    const val_confirm = confirm("Anda yakin ingin menghapus data ini");
    if (val_confirm) {
        fetch(`${url}${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                _method: "DELETE",
                _token: token,
            }),
        })
            .then((res) => res.json())
            .then((res) => {
                window.location.href = url;
            });
    }
};
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// home
$(function () {
    //realtime time
    const this_time = $(".this-time");
    const date = new Date();
    this_time.html(
        `${date.getHours()} : ${date.getMinutes()} : ${date.getSeconds()} `
    );
    function time() {
        const date = new Date();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        if (hours < 10) {
            hours = `0${hours}`;
        }
        if (minutes < 10) {
            minutes = `0${minutes}`;
        }
        if (seconds < 10) {
            seconds = `0${seconds}`;
        }
        this_time.html(`${hours} : ${minutes} : ${seconds} `);
        current_time();
    }
    function current_time() {
        setTimeout(() => {
            time();
        }, 1000);
    }
    current_time();
});

//Teacher managements
$(() => {
    deleteOnClick = (e) => {
        console.log(e.target.getAttribute("data-id"));
        console.log(e.target.getAttribute("data-token"));
        const teacher_id = e.target.getAttribute("data-id");
        const _token = e.target.getAttribute("data-token");
        const on_click = confirm("Apa anda yakin ingin menghapus data ini?");
        if (on_click) {
            fetch(`/dashboard/teachers/${teacher_id}`, {
                method: "Delete",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    _method: "delete",
                    _token: _token,
                }),
            })
                .then((res) => res.json())
                .then((data) => {
                    alert(data.message);
                    window.location.href = "/dashboard/teachers";
                });
        }
    };
});

// datepicker
$(function () {
    $(".datepicker").datepicker({
        todayHighlight: true,
        language: "id",
    });
});

// class section
// parsing class num to roman
$(document).ready(function () {
    const class_value = $(".row.classes #class");
    const class_name = $(".row.classes #name");
    const class_roman = $("#roman");
    const class_id = $(".classes form");

    classToRoman = (e) => {
        class_value.val(e.target.value);

        let names = {
                satu: 1,
                dua: 2,
                tiga: 3,
                empat: 4,
                lima: 5,
                enam: 6,
            },
            name = "",
            j;

        for (j in names) {
            if (e.target.value == names[j]) {
                name = j;
            }
        }

        let value = {
                M: 1000,
                CM: 900,
                D: 500,
                CD: 400,
                C: 100,
                XC: 90,
                L: 50,
                XL: 40,
                X: 10,
                IX: 9,
                V: 5,
                IV: 4,
                I: 1,
            },
            roman = "",
            i;
        for (i in value) {
            while (e.target.value >= value[i]) {
                roman += i;
                e.target.value -= value[i];
            }
        }

        class_name.val(name);
        class_roman.val(roman);
    };

    // fecthing dasta to update
    editClassHandler = (id) => {
        fetch(`/dashboard/classes/${id}/edit`)
            .then((res) => res.json())
            .then((val) => {
                class_id.data("id", val.data.id);
                class_value.val(val.data.class);
                class_name.val(val.data.name);
                class_roman.val(val.data.roman);
                if (class_id.data("id") > 0) {
                    $(".classes form.form-class").prepend(
                        "<input type='hidden' name='_method' value='PUT'>"
                    );
                    $(".classes .form-title").text("Perbarui ");
                    $(".classes .form-title").append(
                        "<a href='/dashboard/classes' class='badge bg-primary fw-normal text-decoration-none text-white' role='button'>Tambah data?</a>"
                    );
                    $(".classes .form-class button")
                        .addClass("btn-success")
                        .removeClass("btn-primary");
                    $(".classes .form-class").attr(
                        "action",
                        `/dashboard/classes/${id}`
                    );
                }
            });
    };
});

//students section dashboard
$(document).ready(function () {
    let pageLimit = $("#pagination_limit").val();
    let page;
    let s_name = $("#search_name").val();
    let s_class = $("#search_class").val();
    let s_gender = $("#search_gender").val();

    $("#search_name").keyup(function (e) {
        s_name = e.target.value;
        e.preventDefault();
        let url = `/dashboard/students?lim=${pageLimit}&&name=${e.target.value}`;
        getData(url);
    });
    filterByGender = (e) => {
        s_gender = e.target.value;
        console.log(s_gender);
        e.preventDefault();
        let url = `/dashboard/students?lim=${pageLimit}&&gender=${e.target.value}`;
        if (s_class != "") {
            url = `/dashboard/students?lim=${pageLimit}&&class=${s_class}&&gender=${e.target.value}`;
        } else {
        }
        getData(url);
    };
    filterByClass = (e) => {
        s_class = e.target.value;
        e.preventDefault();
        let url = `/dashboard/students?lim=${pageLimit}&&class=${e.target.value}`;
        if (s_gender != "") {
            url = `/dashboard/students?lim=${pageLimit}&&class=${e.target.value}&&gender=${s_gender}`;
        }
        getData(url);
    };

    limitOfPaginate = (e) => {
        pageLimit = e.target.value;
        if (s_name != "") {
            getData(
                `/dashboard/students?lim=${e.target.value}&&name=${s_name}`
            );
        } else if (s_class != "") {
            getData(
                `/dashboard/students?lim=${e.target.value}&&class=${s_class}`
            );
        } else if (s_gender != "") {
            getData(
                `/dashboard/students?lim=${e.target.value}&&gender=${s_gender}`
            );
        } else {
            getData(`/dashboard/students?lim=${e.target.value}`);
        }
    };

    paginationOnClick = (e) => {
        e.preventDefault();
        page = e.target.getAttribute("href").split("page=")[1];
        if (s_name != "") {
            getData(
                `/dashboard/students?lim=${pageLimit}&&page=${page}&&name=${s_name}`
            );
        } else if (s_class != "") {
            getData(
                `/dashboard/students?lim=${pageLimit}&&page=${page}&&class=${s_class}`
            );
        } else if (s_gender != "") {
            getData(
                `/dashboard/students?lim=${pageLimit}&&page=${page}&&gender=${s_gender}`
            );
        } else {
            getData(`/dashboard/students?lim=${pageLimit}&&page=${page}`);
        }

        location.hash = `page=` + page;
    };

    getData = (url) => {
        $.ajax({
            type: "GET",
            url: url,
            dataType: "html",
            success: function (data) {
                $("#class_ajax").empty().html(data);
            },
        });
    };

    // create data student section
    const nisn = $("#form-create-students #nisn");
    const name_student = $("#form-create-students #name");
    const username_student = $("#form-create-students #username");
    const password_student = $("#form-create-students #password");
    const gender_student = $("#form-create-students #gender");
    const class_student = $("#form-create-students #class");
    let new_nisn;
    let new_name;

    function check() {
        if (nisn.val() === "") {
            name_student.attr("disabled", true);
            name_student.attr("placeholder", "Masukkan NISN terlebih dahulu.");
        } else {
            name_student.attr("disabled", false);
            name_student.attr("placeholder", "Nama lengkap siswa.");
        }
    }

    check();

    nisnUsernameOnKeyup = (e) => {
        if (e.target.getAttribute("name") === "nisn") {
            new_nisn = e.target.value.replace(/\s/g, "");
            check();
        } else {
            new_name = e.target.value.replace(/\s/g, "");
        }
        username_student.attr(
            "value",
            new_nisn.toString() + new_name.substr(0, 5).toUpperCase()
        );
        password_student.attr(
            "value",
            new Date().getMinutes().toString() +
                new_nisn +
                Math.floor(Math.random() * 99.9)
        );
    };

    //Show data student
    showPasswordStudentOnClick = (role) => {
        let password_show_student = $(".show-student #password");
        if (role != "admin") {
            alert(
                "Anda bukan administrator. Hubungi admin untuk melihat password!."
            );
        } else {
            fetch(`/dashboard/secondaryPasswords/${id}`)
                .then((res) => res.json())
                .then((val) => {
                    password_show_student.text(val.data.secondary_password);
                });
        }
    };

    updateProfileImage = (id, token) => {
        const file_image = $(".show-student #image");

        const type = file_image[0].files[0].type.split("/")[0];
        if (type == "image") {
            const ofReader = new FileReader();
            ofReader.readAsDataURL(file_image[0].files[0]);
            ofReader.onload = function (event) {
                $("#profile-picture").attr("src", event.target.result);
            };
        }

        let form_data = new FormData();
        form_data.append("_method", "PUT");
        form_data.append("_token", token);
        form_data.append("image", file_image[0].files[0]);

        $(".student-img-profile").addClass("loading-img-profile");
        $(".student-img-profile .spinner-border").addClass("active");

        fetch(`/dashboard/students/uploadimage/${id}`, {
            method: "POST",
            body: form_data,
        })
            .then((res) => res.json())
            .then((val) => {
                $(".student-img-profile").removeClass("loading-img-profile");
                $(".student-img-profile .spinner-border").removeClass("active");
                if (val.status == "failed") {
                    $(".show-student .card-header>div:nth-child(1)").after(
                        "<div class='alert alert-danger'>" +
                            val.data.message +
                            "</div>"
                    );
                }
            });
    };
});

// schedules section dashboard
$(document).ready(function () {
    let path = document.location.href.split("/");
    path = path[path.length - 1];
    if (path != "create") {
        document.cookie = `create_schedule_row = 1;path=/`;
    }
    // create schedules
    // add new row
    let schedule_row = $("#create_schedule_row");
    let schedule_form = $("#create_schedule_form");
    let count_cookie = getCookie("create_schedule_row");
    addRowSchedules = () => {
        let num_create_schedule_row = $("#num_create_schedule_row").val();
        document.cookie = `create_schedule_row = ${num_create_schedule_row};path=/`;
        location.href = "/dashboard/schedules/create";
    };

    loopCreateScheduleRow = (total) => {
        for (let i = 1; i < total; i++) {
            schedule_form.append(
                `<div class='row bg-light rounded p-2 pb-3 border mb-3' id='create_schedule_row'>${schedule_row.html()}</div>`
            );
        }
    };
    loopCreateScheduleRow(count_cookie);
});

//Absent section dashboard
$(document).ready(function () {
    let absent_filClass = $("#absent_filter_class");
    let class_value;

    absent_filClass.change(function (e) {
        e.preventDefault();
        class_value = e.target.value;
        $.ajax({
            type: "get",
            url: `/dashboard/absents?class=${e.target.value}`,
            dataType: "html",
            success: function (response) {
                $("#absent_students").html(response);
            },
        });
    });

    absentPaginationOnClick = (e) => {
        e.preventDefault();
        page = e.target.getAttribute("href").split("page=")[1];
        // if (s_name != "") {
        //     getData(
        //         `/dashboard/students?lim=${pageLimit}&&page=${page}&&name=${s_name}`
        //     );
        // } else if (s_class != "") {
        //     getData(
        //         `/dashboard/students?lim=${pageLimit}&&page=${page}&&class=${s_class}`
        //     );
        // } else if (s_gender != "") {
        //     getData(
        //         `/dashboard/students?lim=${pageLimit}&&page=${page}&&gender=${s_gender}`
        //     );
        // } else {
        $.ajax({
            type: "get",
            url: `/dashboard/absents?class=${class_value}&&page=${page}`,
            dataType: "html",
            success: function (response) {
                $("#absent_students").html(response);
            },
        });
        location.hash = `page=` + page;
    };

    //create absents
    absentCheckAll = (id_desc) => {
        let desc_class = $(".form-check-input");
        for (let i = 0; i < desc_class.length; i++) {
            if (desc_class[i].getAttribute("value") == id_desc) {
                desc_class[i].setAttribute("checked", "true");
            } else {
                desc_class[i].removeAttribute("checked");
            }
        }
    };

    setOutOnClick = (id) => {
        let date = new Date();
        let hours = `${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
        if ($("input#" + id).length > 1) {
            $(`input#${id}`).attr("value", hours);
        } else {
            if (date.getHours() < 10 && date.getMinutes() < 10) {
                hours = `0${date.getHours()}:0${date.getMinutes()}`;
            }
            $(`#${id}`).val(hours);
        }
    };
});
