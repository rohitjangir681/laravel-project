@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category Add</h1>
    </section>



    <section class="content">
        {{-- {{ getCategories() }} --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category add</h3>
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
                    <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                                <option value="{{ $category->id }}">
                                                    {{ $i . '. ' }}{{ $category->name }}</option>
                                                    @php
                                                        $j=1;
                                                    @endphp
                                                @foreach (subCategories($category->id) as $subCategory)
                                                    <option value="{{ $subCategory->id }}"> {!! '&nbsp;' !!}
                                                        {{ $i . '.' . $j++ . '.'}}{{ $subCategory->name }}</option>

                                                    @foreach (subSubCategories($subCategory->id) as $subSubCategory)
                                                        <option value="{{ $subSubCategory->id }}"> {!! '&nbsp;&nbsp;&nbsp;&nbsp;' !!}
                                                            -- {{ $subSubCategory->name }}</option>
                                                    @endforeach
                                                @endforeach
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                        </select>

                                    </div>

                                    <label>Category name</label>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter category" value="{{ old('name') }}">
                                        @error('name')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Select status</label>
                                    <div class="form-group @error('status') has-error @enderror">
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Enable
                                            </option>
                                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Disable
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
                                            <option value="1" {{ old('show_in_menu') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ old('show_in_menu') == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('show_in_menu')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Short Description</label>
                                    <div class="form-group @error('short_description') has-error @enderror">
                                        <textarea name="short_description" class="form-control" cols="30" rows="2">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" class="form-control" name="url_key"
                                            placeholder="Enter URL Key" value="{{ old('url_key') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            placeholder="Enter meta tag" value="{{ old('meta_title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" class="form-control" name="meta_tag"
                                            placeholder="Enter meta tag" value="{{ old('meta_tag') }}">
                                    </div>
                                </div><!-- col md 6 end -->


                                <div class="col-md-6">


                                    <label>Description</label>
                                    <div class="form-group @error('description') has-error @enderror">
                                        <textarea name="description" class="form-control" id="editor" cols="30" rows="4">{{ old('description') }}</textarea>
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
                                        <textarea name="meta_description" class="form-control" cols="30" rows="3">{{ old('meta_description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Products</label>
                                        <select name="products[]" multiple class="form-control">
                                            @foreach($products as $_product)
                                            <option value="{{ $_product->id }}">{{ $_product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- col md 6 end-->
                            </div> <!-- row end -->
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="action" value="save" class="btn btn-primary">Save</button>
                            <button type="submit" name="action" value="save_and_new" class="btn btn-primary">Save &
                                New</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
