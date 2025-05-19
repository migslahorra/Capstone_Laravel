<div style="background-color: #0f172a; padding: 40px; border-radius: 10px; max-width: 1000px; margin: auto; color: white;">
    <h2 style="text-align: center; font-size: 24px; margin-bottom: 30px;">Upload Your Property</h2>

    <form action="{{ route('upload.property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: flex; gap: 20px;">
            <!-- Left Column -->
            <div style="flex: 1;">
                <div style="margin-bottom: 15px;">
                    <label for="title">Title</label><br>
                    <input type="text" name="title" id="title" required style="width: 100%; padding: 8px; color: black" >
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="description">Description</label><br>
                    <textarea name="description" id="description" rows="4" style="width: 100%; padding: 8px; color: black"></textarea>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="price_range">Estimated Price</label><br>
                    <input type="text" name="price_range" id="price_range" required style="width: 100%; padding: 8px; color: black">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="area">Area (sq m)</label><br>
                    <input type="text" name="area" id="area" style="width: 100%; padding: 8px; color: black">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="images">Upload Images</label><br>
                    <input type="file" name="images[]" id="images" multiple style="width: 100%; padding: 8px; color: white">
                </div>
            </div>

            <!-- Right Column -->
            <div style="flex: 1;">
                <div style="margin-bottom: 15px;">
                    <label for="address">Address</label><br>
                    <input type="text" name="address" id="address" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="street">Street</label><br>
                    <input type="text" name="street" id="street" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="purok">Purok</label><br>
                    <input type="text" name="purok" id="purok" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="city">City</label><br>
                    <input type="text" name="city" id="city" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="province">Province</label><br>
                    <input type="text" name="province" id="province" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="country">Country</label><br>
                    <input type="text" name="country" id="country" style="width: 100%; padding: 8px; color: black">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="postal_code">Postal Code</label><br>
                    <input type="text" name="postal_code" id="postal_code" style="width: 100%; padding: 8px; color: black">
                </div>
            </div>
        </div>

        <div style="margin-top: 20px; text-align: center;">
        <label for="status">Status</label><br>
        <select name="status" id="status" required style="padding: 8px; width: 50%; color: black;">
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
        </div>

        <!-- Submit -->
        <div style="text-align: center; margin-top: 30px;">
            <button type="submit" style="background-color: #3b82f6; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                <i class="fas fa-upload" style="margin-right: 5px;"></i> Submit Property
            </button>
        </div>
    </form>
</div>

<footer style="padding: 10px;">
    <p style="text-align: center; color: white;">&copy; 2025 LandSeek: A Digital Marketplace for Land Hunting. All Rights Reserved</p>
</footer>
