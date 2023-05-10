<?php

namespace App;

class FTM
{
    public $y; //nilai aktual
    public $next_periode; //jumlah periode berikutnya yang akan diramalkan
    public $x; // variable x dalam trend moment
    public $xy; // perkalian antara $x dan $y
    public $x_kuadrat; //hasil kuadrat dari $x
    public $max_periode; //periode terbesar data aktual
    public $err; //selisih antara data peramalan dan data aktual
    public $err_abs; //nilai absolut dari $err
    public $err_square; //$arr dikuadratkan
    public $err_yt; //$arr dibagi data aktual
    public $rata;


    /**
     * konstrukor class FTM
     * @param array $y data aktual
     * @param int $next_periode jumlah periode berikutnya yang akan diramalkan
     */
    function __construct($y, $next_periode)
    {
        $this->y = $y;
        $this->next_periode = $next_periode;
        $this->hitung();
    }
    /**
     * melakukan perhitungan Trend Moment
     */
    function hitung()
    {
        $a = 0;
        /**
         * mengisi nilai x dari 0 dan ditambah 1 setiap periode
         */

        foreach ($this->y as $key => $val) {
            $this->x[$key] = $a++;
        }
        /**
         * mengalikan $x dan $y
         */
        foreach ($this->y as $key => $val) {
            $this->xy[$key] = $this->x[$key] * $val;
        }
        /**
         * mengkuadratkan nilai $x
         */
        foreach ($this->x as $key => $val) {
            $this->x_kuadrat[$key] = $val * $val;
        }
        /**
         * membuat dua persamaan
         * sum(y) = a.n + b.sum(X) atau $z1 = a$a1 + b$b1
         * sum(xy) = a.sum(x) + b.sum(x_kuadrat) atau $z2 = a$a2 + b$b2  
         */
        $this->z1 = array_sum($this->y); // mentotalkan dari $y
        $this->z2 = array_sum($this->xy); // mentotalkan dari $xy
        $this->a1 = count($this->y); // menghitung dari $y
        $this->a2 = array_sum($this->x); // mentotalkan dari $x
        $this->b1 = array_sum($this->x); // mentotalkan dari $y
        $this->b2 = array_sum($this->x_kuadrat);
        /**
         * menyelesaikan persamaan persamaan untuk mencari nilai a dan b       
         */
        $this->b = ($this->a2 * $this->z1 - $this->a1 * $this->z2) / ($this->a2 * $this->b1 - $this->a1 * $this->b2);
        $this->a = ($this->b2 * $this->z1 - $this->b1 * $this->z2) / ($this->b2 * $this->a1 - $this->b1 * $this->a2);
        /**
         * menghitung nilai peramalan data aktual berdasarkan hasil nilai a dan b     
         * menghitung nilai error (err, err_abs, err_square, err_yt)
         */
        $rata = array_sum($this->y) / count($this->y);
        foreach ($this->x as $key => $val) {
            $this->fx[$key] = $this->a + $this->b * $val; // nilai ra
            $this->err[$key] = $this->fx[$key] - $this->y[$key];
            $this->err_abs[$key] = abs($this->err[$key]);
            $this->err_square[$key] = pow($this->err[$key], 2);
            $this->err_yt[$key] = $this->err_abs[$key] / $this->y[$key];
        }
        $pembagi = count($this->err); //jumlah data
        $this->errs = array(
            'MSE' => array_sum($this->err_square) / $pembagi,
            'RMSE' => sqrt(array_sum($this->err_square) / $pembagi),
            'MAD' => array_sum($this->err_abs) / $pembagi,
            'MAPE' => array_sum($this->err_yt) / $pembagi,
        );
        //mencari periode maksimal sebagai acuan periode berikutnya
        $this->max_periode = max(array_keys($this->y));
        $x = max($this->x);
        /**
         * melakukan forecasting sebanyak $next_periode
         */
        for ($a = 1; $a <= $this->next_periode; $a++) {
            //menentukan periode berikutnya berdasarkan maksimal periode dan nilai $a
            $key = 'Semester 6';
            $x++;
            //nilai x selanjutnya ditambah 1
            $this->next_x[$key] = $x;
            //forecasting didapat berdasarkan nilai a, b, dan x yaitu y = a + b * x
            $this->next_fx[$key] = $this->a + $this->b * $x;
        }
    }
}