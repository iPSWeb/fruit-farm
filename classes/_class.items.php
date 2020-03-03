<?php
class items {
    private $config = NULL;
    function __construct($config_site){
        $this->config = $config_site;	
    }
    public function getItems(){
        $data_items = array(
            'a_t' => array(
                'name' => 'Лимонное дерево',
                'production' => 'Лимон',
                'char' => 'a',
                'in_hour' => $this->config['a_in_h'],
                'price' => $this->config['amount_a_t'],
                'time_life' => 60*60*24*120,//120 дней
                'profit_percent_day' => round($this->config['a_in_h']*24/$this->config['items_per_coin']/$this->config['amount_a_t']*100,4),
                'profit_percent_week' => round($this->config['a_in_h']*24*7/$this->config['items_per_coin']/$this->config['amount_a_t']*100,4),
                'profit_percent_month' => round($this->config['a_in_h']*24*30/$this->config['items_per_coin']/$this->config['amount_a_t']*100,4),
                'profit_serebro_hour' => round($this->config['a_in_h']/$this->config['items_per_coin'],4),
                'profit_serebro_day' => round($this->config['a_in_h']*24/$this->config['items_per_coin'],4),
                'profit_serebro_week' => round($this->config['a_in_h']*24*7/$this->config['items_per_coin'],4),
                'profit_serebro_month' => round($this->config['a_in_h']*24*30/$this->config['items_per_coin'],4),
                'profit_rub_hour' => round($this->config['a_in_h']/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_day' => round($this->config['a_in_h']*24/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_week' => round($this->config['a_in_h']*24*7/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_month' => round($this->config['a_in_h']*24*30/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'img' => '/assets/style/img/fruit/a_t.jpg',
                'img_small' => '/assets/style/img/fruit/a_t-small.jpg'
            ),
            'b_t' => array(
                'name' => 'Вишневое дерево',
                'production' => 'Вишня',
                'char' => 'b',
                'in_hour' => $this->config['b_in_h'],
                'price' => $this->config['amount_b_t'],
                'time_life' => 60*60*24*100,//100 дней
                'profit_percent_day' => round($this->config['b_in_h']*24/$this->config['items_per_coin']/$this->config['amount_b_t']*100,4),
                'profit_percent_week' => round($this->config['b_in_h']*24*7/$this->config['items_per_coin']/$this->config['amount_b_t']*100,4),
                'profit_percent_month' => round($this->config['b_in_h']*24*30/$this->config['items_per_coin']/$this->config['amount_b_t']*100,4),
                'profit_serebro_hour' => round($this->config['b_in_h']/$this->config['items_per_coin'],4),
                'profit_serebro_day' => round($this->config['b_in_h']*24/$this->config['items_per_coin'],4),
                'profit_serebro_week' => round($this->config['b_in_h']*24*7/$this->config['items_per_coin'],4),
                'profit_serebro_month' => round($this->config['b_in_h']*24*30/$this->config['items_per_coin'],4),
                'profit_rub_hour' => round($this->config['b_in_h']/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_day' => round($this->config['b_in_h']*24/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_week' => round($this->config['b_in_h']*24*7/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_month' => round($this->config['b_in_h']*24*30/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'img' => '/assets/style/img/fruit/b_t.jpg',
                'img_small' => '/assets/style/img/fruit/b_t-small.jpg'
            ),
            'c_t' => array(
                'name' => 'Куст клубники',
                'production' => 'Клубника',
                'char' => 'c',
                'in_hour' => $this->config['c_in_h'],
                'price' => $this->config['amount_c_t'],
                'time_life' => 60*60*24*90,//90 дней
                'profit_percent_day' => round($this->config['c_in_h']*24/$this->config['items_per_coin']/$this->config['amount_c_t']*100,4),
                'profit_percent_week' => round($this->config['c_in_h']*24*7/$this->config['items_per_coin']/$this->config['amount_c_t']*100,4),
                'profit_percent_month' => round($this->config['c_in_h']*24*30/$this->config['items_per_coin']/$this->config['amount_c_t']*100,4),
                'profit_serebro_hour' => round($this->config['c_in_h']/$this->config['items_per_coin'],4),
                'profit_serebro_day' => round($this->config['c_in_h']*24/$this->config['items_per_coin'],4),
                'profit_serebro_week' => round($this->config['c_in_h']*24*7/$this->config['items_per_coin'],4),
                'profit_serebro_month' => round($this->config['c_in_h']*24*30/$this->config['items_per_coin'],4),
                'profit_rub_hour' => round($this->config['c_in_h']/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_day' => round($this->config['c_in_h']*24/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_week' => round($this->config['c_in_h']*24*7/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_month' => round($this->config['c_in_h']*24*30/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'img' => '/assets/style/img/fruit/c_t.jpg',
                'img_small' => '/assets/style/img/fruit/c_t-small.jpg'
            ),
            'd_t' => array(
                'name' => 'Дерево киви',
                'production' => 'Киви',
                'char' => 'd',
                'in_hour' => $this->config['d_in_h'],
                'price' => $this->config['amount_d_t'],
                'time_life' => 60*60*24*60,//60 дней
                'profit_percent_day' => round($this->config['d_in_h']*24/$this->config['items_per_coin']/$this->config['amount_d_t']*100,4),
                'profit_percent_week' => round($this->config['d_in_h']*24*7/$this->config['items_per_coin']/$this->config['amount_d_t']*100,4),
                'profit_percent_month' => round($this->config['d_in_h']*24*30/$this->config['items_per_coin']/$this->config['amount_d_t']*100,4),
                'profit_serebro_hour' => round($this->config['d_in_h']/$this->config['items_per_coin'],4),
                'profit_serebro_day' => round($this->config['d_in_h']*24/$this->config['items_per_coin'],4),
                'profit_serebro_week' => round($this->config['d_in_h']*24*7/$this->config['items_per_coin'],4),
                'profit_serebro_month' => round($this->config['d_in_h']*24*30/$this->config['items_per_coin'],4),
                'profit_rub_hour' => round($this->config['d_in_h']/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_day' => round($this->config['d_in_h']*24/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_week' => round($this->config['d_in_h']*24*7/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_month' => round($this->config['d_in_h']*24*30/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'img' => '/assets/style/img/fruit/d_t.jpg',
                'img_small' => '/assets/style/img/fruit/d_t-small.jpg'
            ),
            'e_t' => array(
                'name' => 'Дерево апельсинов',
                'production' => 'Апельсин',
                'char' => 'e',
                'in_hour' => $this->config['e_in_h'],
                'price' => $this->config['amount_e_t'],
                'time_life' => 60*60*24*50,//50 дней
                'profit_percent_day' => round($this->config['e_in_h']*24/$this->config['items_per_coin']/$this->config['amount_e_t']*100,4),
                'profit_percent_week' => round($this->config['e_in_h']*24*7/$this->config['items_per_coin']/$this->config['amount_e_t']*100,4),
                'profit_percent_month' => round($this->config['e_in_h']*24*30/$this->config['items_per_coin']/$this->config['amount_e_t']*100,4),
                'profit_serebro_hour' => round($this->config['e_in_h']/$this->config['items_per_coin'],4),
                'profit_serebro_day' => round($this->config['e_in_h']*24/$this->config['items_per_coin'],4),
                'profit_serebro_week' => round($this->config['e_in_h']*24*7/$this->config['items_per_coin'],4),
                'profit_serebro_month' => round($this->config['e_in_h']*24*30/$this->config['items_per_coin'],4),
                'profit_rub_hour' => round($this->config['e_in_h']/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_day' => round($this->config['e_in_h']*24/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_week' => round($this->config['e_in_h']*24*7/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'profit_rub_month' => round($this->config['e_in_h']*24*30/$this->config['items_per_coin']/$this->config['ser_per_wmr'],4),
                'img' => '/assets/style/img/fruit/e_t.jpg',
                'img_small' => '/assets/style/img/fruit/e_t-small.jpg'
            ),           
        );
        return $data_items;
    }
}