// global function
onDeleteButton = (e, id, token) => {
    e.preventDefault();
    const val_confirm = confirm("Anda yakin ingin menghapus data ini");
    if (val_confirm) {
        fetch(`/dashboard/classes/${id}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                _method: "DELETE",
                _token: token,
            }),
        }).then(() => {
            window.location.href = "/dashboard/classes";
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
function classToRoman(e) {
    $(".row.classes #class").val(e.target.value);
    console.log($(".row.classes #class"));
    console.log("sfhskhf");
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

    $(e.target).attr("selected");
    $(".row.classes #name").val(name);
    $("#roman").val(roman);
}
