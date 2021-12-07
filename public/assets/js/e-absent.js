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
        }).then(() => {
            window.location.href = url;
        });
    }
};

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

//students section
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
});
