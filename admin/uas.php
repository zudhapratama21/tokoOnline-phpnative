
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>
    <form action="input_data.php" class="form-control" method="POST">
        <fieldset>
        <legend align="center">Biodata</legend>
        <p class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama"  class="form-control" />
        </p>
        <p>
            <label>Tempat,Tanggal Lahir</label>
            <input type="text" name="lokasi" />
            <input type="date" name="tanggal">
            
        </p>
        <p>
            <label>Alamat</label>
            <textarea ></textarea>
        </p>
        <p>
            <label>Jenis kelamin:</label>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki" /> Laki-laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan" /> Perempuan</label>
        </p>
        <p>
            <label>Agama:</label>
            <select name="agama">
                <option value="islam">Islam</option>
                <option value="kristen">Kristen</option>
                <option value="hindu">Hindu</option>
                <option value="budha">Budha</option>
            </select>
        </p>
        <p>
            <label>Kwarganegaraan</label>
            <select name="kwarganegaraan">
            <option value="WNA">WNA</option>
            <option value="WNI">WNI</option>
            </select>
        </p>

        <p>
            <label>Hobi:</label>
           
            <label><input type="radio" name="musik" value="musik" /> musik</label>
            <label><input type="radio" name="olahraga" value="olahraga" /> olahraga</label>
             <label><input type="radio" name="travelling" value="travelling" /> Travelling</label>
             
           
        </p>
            <input type="submit" name="kirim">
            <input type="reset" name="hapus">
        </fieldset>
    </form>
</body>
</html>