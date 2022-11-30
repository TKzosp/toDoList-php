< !DOCTYPE html >
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Todo list</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <script
            class="boostrap"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
            crossorigin="anonymous"
        ></script>

        <section class="vh-100" style="background-color: #eee">
            <div class="container py-5 h-100">
                <div
                    class="row d-flex justify-content-center align-items-center h-100"
                >
                    <div class="col col-lg-9 col-xl-7">
                        <div class="card rounded-3">
                            <div class="card-body p-4">
                                <h4 class="text-center my-3 pb-3">
                                    My ToDoList
                                </h4>

                                <form
                                    class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2"
                                >
                                    <div class="col-12">
                                        <div class="form-outline">
                                            <input
                                                type="text"
                                                id="AddTask"
                                                class="form-control"
                                            />
                                            <label
                                                class="form-label"
                                                for="AddTask"
                                                >Insert task here</label
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button
                                            type="button"
                                            id="SubmitTask"
                                            class="btn btn-primary"
                                            onclick="saveTask()"
                                        >
                                            Add task
                                        </button>
                                    </div>
                                </form>

                                <table class="table mb-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Task number</th>
                                            <th scope="col">Task</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            function getTasks() {
                $.ajax({
                    type: "GET",
                    url: "/tasks",
                    success: function (data) {
                        console.log(data);
                        const table = document.getElementsByTagName("tbody")[0];
                        table.innerHTML = "";
                        if (data.length === 0) {
                            const row = table.insertRow(0);
                            const cell = row.insertCell(0);
                            cell.innerHTML = "No tasks yet";
                        } else {
                            for (let index = 0; index < data.length; index++) {
                                const row = table.insertRow(index);
                                const cell1 = row.insertCell(0);
                                const cell2 = row.insertCell(1);
                                const cell3 = row.insertCell(2);
                                const cell4 = row.insertCell(3);
                                cell1.innerHTML = data[index].id;
                                cell2.innerHTML = data[index].name;
                                cell3.innerHTML = `<button class='btn btn-primary' >Edit</button>`;
                                cell4.innerHTML = `<button class='btn btn-danger' onClick="deleteTask(${data[index].id});">Delete</button>`;
                            }
                        }
                    },
                });
            }
            getTasks();
            function saveTask() {
                const todo = document.getElementById("AddTask").value;
                if (todo.trim().length === 0) {
                    return alert("Please, enter a task!");
                }
                $.ajax({
                    type: "POST",
                    url: "/tasks",
                    data: {
                        name: todo,
                    },
                    success: function () {
                        getTasks();
                    },
                    error: function (data) {
                        alert(`Error ${JSON.stringify(data)}`);
                    },
                });
            }
            function deleteTask(id) {
                $.ajax({
                    type: "DELETE",
                    url: `/tasks/${id}`,
                    success: function () {
                        getTasks();
                    },
                    error: function (data) {
                        alert(`Error ${JSON.stringify(data)}`);
                    },
                });
            }
        </script>
    </body>
</html>
