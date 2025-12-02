    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create(table: 'siswas', callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'nisn')->unique();
                $table->string(column: 'nama_lengkap');
                $table->enum(column: 'jenis_kelamin', allowed: ['laki-laki', 'perempuan']);
                $table->date(column: 'tanggal_lahir');
                $table->text(column: 'alamat');
                $table->foreignId(column: 'jurusan_id')->constrained(table: 'jurusans')->cascadeOnDelete();
                $table->foreignId(column: 'kelas_id')->constrained(table: 'kelas')->cascadeOnDelete();
                $table->foreignId(column: 'tahun_ajar_id')->constrained(table: 'tahun_ajars')->cascadeOnDelete();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('siswas');
        }
    };
