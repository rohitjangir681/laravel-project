@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category Edit</h1>
    </section>



    <section class="content">
        {{-- {{ getCategories() }} --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category Edit</h3>
                        @can('category_index')
                            <a href="{{ route('category.index') }}" class="btn btn-primary" style="float: right;">Category list</a>
                        @endcan
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="margin-top: 20px;">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.update', $categoryData->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Parent Catogery</label>
                                        <select name="category_parent_id" class="form-control">
                                            <option value="">Select Parent Catogery</option>

                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach (getCategories() as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $categoryData->category_parent_id == $category->id ? 'selected' : '' }}>
                                                    {{ $i++ . '. ' }}{{ $category->name }}</option>
                                                @foreach (subCategories($category->id) as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ $categoryData->category_parent_id == $subCategory->id ? 'selected' : '' }}>
                                                        {!! '&nbsp;' !!}
                                                        --{{ $subCategory->name }}</option>

                                                    @foreach (subSubCategories($subCategory->id) as $subSubCategory)
                                                        <option value="{{ $subSubCategory->id }}"> {!! '&nbsp;&nbsp;&nbsp;&nbsp;' !!}
                                                            -- {{ $subSubCategory->name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>

                                    </div>

                                    <label>Category name</label>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter category" value="{{ $categoryData->name }}">
                                        @error('name')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Select status</label>
                                    <div class="form-group @error('status') has-error @enderror">
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ $categoryData->status == 1 ? 'selected' : '' }}>
                                                Enable</option>
                                            <option value="2" {{ $categoryData->status == 2 ? 'selected' : '' }}>
                                                Disable
                                            </option>
                                        </select>
                                        @error('status')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Show in Menu</label>
                                    <div class="form-group @error('show_in_menu') has-error @enderror">
                                        <select name="show_in_menu" class="form-control">
                                            <option value="">Select Menu Status</option>
                                            <option value="1"
                                                {{ $categoryData->show_in_menu == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2"
                                                {{ $categoryData->show_in_menu == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('show_in_menu')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Short Description</label>
                                    <div class="form-group @error('short_description') has-error @enderror">
                                        <textarea name="short_description" class="form-control" cols="30" rows="2">{{ $categoryData->short_description }}</textarea>
                                        @error('short_description')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="Enter meta tag" value="{{ $categoryData->meta_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" class="form-control" name="meta_tag"
                                            placeholder="Enter meta tag" value="{{ $categoryData->meta_tag }}">
                                    </div>
                                </div><!-- col md 6 end -->


                                <div class="col-md-6">


                                    <label>Description</label>
                                    <div class="form-group @error('description') has-error @enderror">
                                        <textarea name="description" class="form-control" id="editor" cols="30" rows="4">{{ $categoryData->description }}</textarea>
                                        @error('description')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="3">{{ $categoryData->meta_description }}</textarea>
                                    </div>

                                    {{-- @php
                                        $test = $categoryData->products();
                                        // print_r($test);
                                        foreach($test as $tete) {
                                            // echo $tete;
                                            print_r($tete);
                                        }

                                        @endphp --}}


                                    <div class="form-group">
                                        <label>Products</label>
                                        <select name="products[]" multiple class="form-control">
                                            @foreach ($products as $_product)
                                                {{-- <option value="{{ $_product->id }}">{{ $_product->name }}</option> --}}
                                                <option value="{{ $_product->id }}"
                                                    {{ in_array($_product->id, $categoryData->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $_product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div> <!-- col md 6 end-->
                            </div> <!-- row end -->
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" value="save" class="btn btn-primary">Update</button>

                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
