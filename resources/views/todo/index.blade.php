@include('layouts.header')
<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
  <div class="page-content">
    <div class="transition-all duration-150 container-fluid" id="page_layout">
      <div id="content_layout">
        <!-- BEGIN: Breadcrumb -->
        <div class="mb-5">
          <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
              <a href="#">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
              </a>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Todo</li>
          </ul>
        </div>
        <!-- END: BreadCrumb -->
        <div class=" space-y-5">
          <div class="card">
            <header class=" card-header noborder">
              <h4 class="card-title">TODO</h4>
              {{-- <button type="button" class="btn btn-primary float-end waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#addNewNetwork">Add new Network</button> --}}
              <button data-bs-toggle="modal" data-bs-target="#form_modal" class="btn inline-flex justify-center btn-dark rounded-[25px]">
                <span class="flex items-center">
                    <iconify-icon class="text-xl" icon="heroicons-outline:plus"></iconify-icon>
                    <span>&nbsp;Create</span>
                </span>
              </button>
            </header>
            <div class="card-body px-6 pb-6">
              <div class="overflow-x-auto -mx-6 dashcode-data-table">
                <span class=" col-span-8  hidden"></span>
                <span class="  col-span-4 hidden"></span>
                <div class="inline-block min-w-full align-middle">
                  <div class="overflow-hidden ">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                      <thead class=" bg-slate-200 dark:bg-slate-700">
                        <tr>
                          <th scope="col" class=" table-th "> S/N </th>
                          <th scope="col" class=" table-th "> Title </th>
                          <th scope="col" class=" table-th "> Description </th>
                          <th scope="col" class=" table-th "> Status </th>
                          <th scope="col" class=" table-th "> Action </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($items as $todo)
                        <tr>
                            <td class="table-td">{{ $count }}</td>
                            <td class="table-td">{{ $todo->title }}</td>
                            <td class="table-td">{{ $todo->description }}</td>
                            <td class="table-td">
                              <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-{!! status($todo->completed) !!}-500
                                bg-{!! status($todo->completed) !!}-500">{{ ($todo->completed ? "YES" : "NO") }}</div>
                            </td>
                            <td class='table-td '>
                                <div class='flex space-x-3 rtl:space-x-reverse'>
                                    <button class='edit-button action-btn' type='button' data-bs-toggle="modal" data-bs-target="#edit_modal{{ $todo->_id }}" >
                                        <iconify-icon icon='heroicons:pencil-square'></iconify-icon>
                                    </button>
                                    <button class='delete-button action-btn' type='button' data-bs-toggle="modal" data-bs-target="#delete_modal{{ $todo->_id }}">
                                        <iconify-icon icon='heroicons:trash'></iconify-icon>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <div class='modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto' id='delete_modal{{ $todo->_id }}' tabindex='-1' aria-labelledby='delete_modal{{ $todo->_id }}' aria-hidden='true' style="display: none;">
                            <div class='modal-dialog relative w-auto pointer-events-none'>
                                <div class='modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                                            rounded-md outline-none text-current'>
                                <div class='relative bg-white rounded-lg shadow dark:bg-slate-700'>
                                    <!-- Modal header -->
                                    <div class='flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-danger-500'>
                                    <h3 class='text-base font-medium text-white dark:text-white capitalize'>
                                    </h3>
                                    <button type='button' class='text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                                                        dark:hover:bg-slate-600 dark:hover:text-white' data-bs-dismiss='modal'>
                                        <svg aria-hidden='true' class='w-5 h-5' fill='#ffffff' viewbox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
                                        <path fill-rule='evenodd' d='M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                                                11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z' clip-rule='evenodd'></path>
                                        </svg>
                                        <span class='sr-only'>Close modal</span>
                                    </button>
                                    </div>
                                                <!-- Modal body -->
                                    <form action="{{ route('todo.delete', ['todo' => $todo->_id]) }}" method='POST'>
                                        @csrf
                                        <div class='p-6 space-y-4'>
                                                <h6 class='text-base text-slate-900 dark:text-white leading-6'>
                                                    Permanetely delete item(s)
                                                </h6>
                                                <p class='text-base text-slate-600 dark:text-slate-400 leading-6'>
                                                    Are you sure you want to delete the todo ({{ $todo->title }}).
                                                </p>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class='flex items-center p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600'>
                                                <button data-bs-dismiss='modal' type='button' class='btn inline-flex justify-center btn-outline-dark'>Close</button>
                                                <button type='submit' class='btn inline-flex justify-center text-white bg-danger-500'>Delete</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="edit_modal{{ $todo->_id }}" tabindex="-1" aria-labelledby="edit_modal" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md relative w-auto pointer-events-none">
                              <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                <div class="relative w-full h-full max-w-xl md:h-auto">
                                  <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                      <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                        {{ $todo->title }}
                                      </h3>
                                      <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex
                                            items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                                    11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                      </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div>
                                        <form action="{{ route('todo.update', ['todo' => $todo->_id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="p-6 space-y-6">
                                                <div class="input-group">
                                                    <label for="name" class="text-sm font-Inter font-normal text-slate-900 block">Title</label>
                                                    <input name="title" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                                                                !border-slate-400 rounded-md mt-2" placeholder="Quick Todo" required value="{{ $todo->title }}"/>
                                                </div>
                                                <div class="input-group">
                                                    <label for="description" class="text-sm font-Inter font-normal text-slate-900 block">Description</label>
                                                    <textarea name="description" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                                                                !border-slate-400 rounded-md mt-2" placeholder="A beautiful Todo" required>{{ $todo->description }}</textarea>
                                                </div>
                                                <div class="input-group">
                                                    <label for="select2basic" class="text-sm font-Inter font-normal text-slate-900 block">Completed</label>
                                                    <select name="completed" id="completed" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                                                    !border-slate-400 rounded-md mt-2" required>
                                                        <option {!! select_dropdown($todo->completed, 'none') !!} disabled="disabled" value="none" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Select Completed</option>
                                                        <option {!! select_dropdown($todo->completed, true) !!} value="yes" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Yes</option>
                                                        <option {!! select_dropdown($todo->completed, false) !!} value="no" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                            <button data-bs-dismiss="modal" type="button" class="btn inline-flex justify-center btn-outline-dark">Close</button>
                                            <button type="submit" class="btn inline-flex justify-center text-white bg-black-500">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        @php
                            $count++;
                        @endphp
                        @endforeach
                      </tbody>
                    </table>
                    <div id="form_modal" tabindex="-1" aria-labelledby="form_modal" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-md relative w-auto pointer-events-none">
                        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                          <div class="relative w-full h-full max-w-xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                              <!-- Modal header -->
                              <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                  Create Todo
                                </h3>
                                <button type="button" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex
                                      items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                                  <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                              11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                  </svg>
                                  <span class="sr-only">Close modal</span>
                                </button>
                              </div>
                              <!-- Modal body -->
                              <div>
                                <form action="{{ route('todo.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                  <div class="p-6 space-y-6">
                                    <div class="input-group">
                                        <label for="name" class="text-sm font-Inter font-normal text-slate-900 block">Title</label>
                                        <input name="title" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                                                    !border-slate-400 rounded-md mt-2" placeholder="Quick Todo" required/>
                                    </div>
                                    <div class="input-group">
                                        <label for="description" class="text-sm font-Inter font-normal text-slate-900 block">Description</label>
                                        <textarea name="description" class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 focus:!outline-none focus:!ring-0 border
                                                    !border-slate-400 rounded-md mt-2" placeholder="A beautiful Todo" required></textarea>
                                    </div>
                                  </div>
                                  <!-- Modal footer -->
                                  <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                    <button data-bs-dismiss="modal" type="button" class="btn inline-flex justify-center btn-outline-dark">Close</button>
                                    <button type="submit" class="btn inline-flex justify-center text-white bg-black-500">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@include('layouts.footer')