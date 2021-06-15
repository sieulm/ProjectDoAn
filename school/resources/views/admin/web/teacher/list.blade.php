@extends('admin.layouts.master')

@section('title')
Tất cả giảng viên
@endsection

@section('style')
<style>
    .custom-ul li {
        list-style-type: square;
        margin-left: -18px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <a href="{{ Route('admin.teacher.create') }}"><button class="btn btn-primary mb-3">
    Tạo mới
    </button></a>
    <a href="{{ Route('admin.teacher.import') }}"><button class="btn btn-success mb-3">
    Import file
    </button></a>
        
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
            Tất cả giảng viên
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                Tên
                            </th>
                            <th scope="col">
                                Ảnh
                            </th>
                            <th scope="col">
                                Thông tin
                            </th>
                            <th scope="col">
                                Trạng thái
                            </th>
                            <th scope="col">
                                Chỉnh sửa
                            </th>
                            <th scope="col">
                                Xoá
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <th scope="col">
                                    {{$loop->iteration}}
                                </th>
                                <th>
                                    {{ $teacher->name }}
                                </th>
                                <th>
                                    @if(strpos("http", $teacher->img) == false)
                                    <img src="{{ URL::asset($teacher->img) }}" alt="" width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                    @else
                                    <img src="https://i.imgur.com/jJ4Iy9p.png" alt="" width="50px" style="border-radius: 50%;">
                                    @endif
                                </th>
                                <th>
                                    <ul class="custom-ul">
                                        <li>
                                            Vị trí: {{ $teacher->User->Role->name }}
                                        </li>
                                        <li>
                                            Học hàm/Học vị: {{ $teacher->User->title }}
                                        </li>
                                        @if($teacher->Department != null)
                                        <li>
                                            Phòng ban: {{ $teacher->Department->name }}
                                        </li>
                                        @endif
                                        <li>
                                            SĐT: {{ $teacher->phone }}
                                        </li>
                                        <li>
                                            Email: {{ $teacher->email }}
                                        </li>
                                        <li>
                                            Giới tính: 
                                            @if($teacher->gender == 1)
                                            Nam
                                            @elseif($teacher->gender == 2)
                                            Nữ
                                            @else
                                            Khác
                                            @endif
                                        </li>
                                        <li>
                                            Ngày sinh: {{date('d/m/Y', strtotime($teacher->dob))}}
                                        </li>
                                        <li>
                                            Ngày làm việc: {{date('d/m/Y', strtotime($teacher->doj))}}
                                        </li>
                                        <li>
                                            Địa chỉ: {{ $teacher->address }}
                                        </li>
                                    </ul>
                                </th>
                                <th scope="col">
                                    @if($teacher->status == 1)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </th>
                                <th>
                                    <a href="{{ Route('admin.teacher.update', ['id' => $teacher->id]) }}">
                                        <button class="btn btn-info">
                                        Sửa
                                        </button>
                                    </a>
                                </th>
                                <th>
                                    <form method="post" action="../../employees/{{$teacher->id}}" onsubmit="return confirm('Bạn chắc muốn xoá chứ?')">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" name="" value="Xoá" class="btn btn-danger">
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $teachers->links() }}
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('teacherLi').classList.add('active');
</script>
@endsection
