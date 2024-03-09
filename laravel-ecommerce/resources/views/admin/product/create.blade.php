@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Product Add</h1>
    </section>

    {{-- {{ $categories }} --}}

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Product add</h3>
                        <a href="{{ route('product.index') }}" style="float:right;" class="btn btn-primary">Product list</a>
                        @if (session()->has('success'))
                            <div class="callout callout-success" style="margin-top: 20px;">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Product name</label>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter product name" value="{{ old('name') }}">
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

                                    <label>Is featured</label>
                                    <div class="form-group @error('is_featured') has-error @enderror">
                                        <select name="is_featured" class="form-control">
                                            <option value="">Select featured</option>
                                            <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="2" {{ old('is_featured') == 2 ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                        @error('is_featured')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>


                                    <label>Stock Keeping Unit(sku)</label>
                                    <div class="form-group @error('sku') has-error @enderror">
                                        <input type="text" class="form-control" name="sku" step="any"
                                            placeholder="Product sku" value="{{ old('sku') }}">
                                        @error('sku')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Quantity (qty)</label>
                                    <div class="form-group @error('qty') has-error @enderror">
                                        <input type="number" class="form-control" step="any" name="qty"
                                            placeholder="Product qty" value="{{ old('qty') }}">
                                        @error('qty')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Stock status</label>
                                    <div class="form-group @error('stock_status') has-error @enderror">
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1" {{ old('stock_status') == 1 ? 'selected' : '' }}>In
                                                Stock
                                            </option>
                                            <option value="2" {{ old('stock_status') == 2 ? 'selected' : '' }}>Out of
                                                Stock</option>
                                        </select>
                                        @error('stock_status')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Weight</label>
                                    <div class="form-group @error('weight') has-error @enderror">
                                        <input type="number" class="form-control" step="any" name="weight"
                                            placeholder="Product weight" value="{{ old('weight') }}">
                                        @error('weight')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <label>Price</label>
                                    <div class="form-group @error('price') has-error @enderror">
                                        <input type="number" class="form-control" step="any" name="price"
                                            placeholder="Product price" value="{{ old('price') }}">
                                        @error('price')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            placeholder="Product special price" value="{{ old('special_price') }}">
                                    </div>

                                    <label>URL Key</label>
                                    <div class="form-group">
                                        <input type="text" name="url_key" class="form-control"
                                            placeholder="Product url key" value="{{ old('url_key') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="datetime-local" class="form-control" name="special_price_from"
                                            value="{{ old('special_price_from') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="datetime-local" class="form-control" name="special_price_to"
                                            value="{{ old('special_price_to') }}">
                                    </div>
                                    <label>Short description</label>
                                    <div class="form-group @error('short_description') has-error @enderror">
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>

                                    {{-- {{ $attributes }} --}}

                                    {{-- {{ $attributes->attributeValues }} --}}
                                    <div class="form-group">
                                        <label>Attributes</label><br>
                                        @foreach (getAttribute() as $attribute)
                                            ----<input type="checkbox" class="test" value="{{ $attribute->id }}" name="attributes[]" selected>
                                            {{ $attribute->name }} &nbsp; &nbsp; &nbsp; <br>
                                        <div class="test">
                                            @foreach ($attribute->attributeValues as $attributeValue)
                                                <input type="checkbox" value="{{ $attributeValue->id }}"
                                                    name="attribute_values[{{ $attribute->id }}][]">
                                                {{ $attributeValue->name }} <br>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>


                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" class="form-control" multiple>
                                            @foreach ($products as $_product)
                                                <option value="{{ $_product->id }}">{{ $_product->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="related_product" class="form-control"
                                            placeholder="Related product" value="{{ old('related_product') }}"> --}}
                                    </div>



                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag" value="{{ old('meta_tag') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{ old('meta_title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{ old('meta_description') }}</textarea>
                                    </div>


                                    <label>Description</label>
                                    <div class="form-group @error('description') has-error @enderror">
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <label class="control-label" style="font-weight: 600;"><i
                                                    class="fa fa-times-circle-o"></i> {{ $message }}</label>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="banner_image[]" class="form-control" multiple />

                                    </div>

                                    <div class="form-group">
                                        <label>Thumbnail Image</label>
                                        <input type="file" name="thumbnail_image" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Categories</label>
                                        <select name="categories[]" multiple class="form-control">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" value="save"
                                            name="action">Save</button>
                                        <button type="submit" class="btn btn-primary" value="save_and_new"
                                            name="action">Save & New</button>
                                    </div>

                                </div>
                            </div> <!-- row end -->

                        </div><!-- /.box-body -->


                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>

 



@endsection
