<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/12
 * Time: 9:14
 */

namespace extend\Tool;


/**
 * 汉字转化为拼音类
 */
class Pinyin {


    /**
     * 汉字ASCII码库
     * @var array
     */
    protected $lib;


    /**
     * 构造函数
     * @return void
     */
    public function __construct() {

    }


    /**
     * 汉字转化并输出拼音
     * @param string $str 所要转化拼音的汉字
     * @param boolean $utf8  汉字编码是否为utf8
     * @return string
     */
    public function output($str, $utf8 = true) {
        //参数分析
        if (!$str) {
            return false;
        }


        //编码转换.
        $str = ($utf8 == true) ? $this->iconvStr('utf-8', 'gbk', $str) : $str;
        $num = strlen($str);


        $pinyin = '';
        for ($i = 0; $i < $num; $i++) {
            $temp = ord(substr($str, $i, 1));
            if ($temp > 160) {
                $temp2 = ord(substr($str, ++$i, 1));
                $temp = $temp * 256 + $temp2 - 65536;
            }
            $pinyin .= $this->num2str($temp);
        }


        //输出的拼音编码转换.
        return ($utf8 == true) ? $this->iconvStr('gbk', 'utf-8', $pinyin) : $pinyin;
    }


    /**
     * 将ASCII编码转化为字符串.
     * @param integer $num
     * @return string
     */
    protected function num2str($num) {


        if (!$this->lib) {
            $this->parse_lib();
        }


        if ($num > 0 && $num < 160) {


            return chr($num);
        } elseif ($num < -20319 || $num > -10247) {


            return '';
        } else {
            $total = sizeof($this->lib) - 1;
            for ($i = $total; $i >= 0; $i--) {
                if ($this->lib[$i][1] <= $num) {
                    break;
                }
            }


            return $this->lib[$i][0];
        }
    }


    /**
     * 返回汉字编码库
     * @return array
     */
    protected function parse_lib() {


        return $this->lib = array(
            array("a", -20319),
            array("ai", -20317),
            array("an", -20304),
            array("ang", -20295),
            array("ao", -20292),
            array("ba", -20283),
            array("bai", -20265),
            array("ban", -20257),
            array("bang", -20242),
            array("bao", -20230),
            array("bei", -20051),
            array("ben", -20036),
            array("beng", -20032),
            array("bi", -20026),
            array("bian", -20002),
            array("biao", -19990),
            array("bie", -19986),
            array("bin", -19982),
            array("bing", -19976),
            array("bo", -19805),
            array("bu", -19784),
            array("ca", -19775),
            array("cai", -19774),
            array("can", -19763),
            array("cang", -19756),
            array("cao", -19751),
            array("ce", -19746),
            array("ceng", -19741),
            array("cha", -19739),
            array("chai", -19728),
            array("chan", -19725),
            array("chang", -19715),
            array("chao", -19540),
            array("che", -19531),
            array("chen", -19525),
            array("cheng", -19515),
            array("chi", -19500),
            array("chong", -19484),
            array("chou", -19479),
            array("chu", -19467),
            array("chuai", -19289),
            array("chuan", -19288),
            array("chuang", -19281),
            array("chui", -19275),
            array("chun", -19270),
            array("chuo", -19263),
            array("ci", -19261),
            array("cong", -19249),
            array("cou", -19243),
            array("cu", -19242),
            array("cuan", -19238),
            array("cui", -19235),
            array("cun", -19227),
            array("cuo", -19224),
            array("da", -19218),
            array("dai", -19212),
            array("dan", -19038),
            array("dang", -19023),
            array("dao", -19018),
            array("de", -19006),
            array("deng", -19003),
            array("di", -18996),
            array("dian", -18977),
            array("diao", -18961),
            array("die", -18952),
            array("ding", -18783),
            array("diu", -18774),
            array("dong", -18773),
            array("dou", -18763),
            array("du", -18756),
            array("duan", -18741),
            array("dui", -18735),
            array("dun", -18731),
            array("duo", -18722),
            array("e", -18710),
            array("en", -18697),
            array("er", -18696),
            array("fa", -18526),
            array("fan", -18518),
            array("fang", -18501),
            array("fei", -18490),
            array("fen", -18478),
            array("feng", -18463),
            array("fo", -18448),
            array("fou", -18447),
            array("fu", -18446),
            array("ga", -18239),
            array("gai", -18237),
            array("gan", -18231),
            array("gang", -18220),
            array("gao", -18211),
            array("ge", -18201),
            array("gei", -18184),
            array("gen", -18183),
            array("geng", -18181),
            array("gong", -18012),
            array("gou", -17997),
            array("gu", -17988),
            array("gua", -17970),
            array("guai", -17964),
            array("guan", -17961),
            array("guang", -17950),
            array("gui", -17947),
            array("gun", -17931),
            array("guo", -17928),
            array("ha", -17922),
            array("hai", -17759),
            array("han", -17752),
            array("hang", -17733),
            array("hao", -17730),
            array("he", -17721),
            array("hei", -17703),
            array("hen", -17701),
            array("heng", -17697),
            array("hong", -17692),
            array("hou", -17683),
            array("hu", -17676),
            array("hua", -17496),
            array("huai", -17487),
            array("huan", -17482),
            array("huang", -17468),
            array("hui", -17454),
            array("hun", -17433),
            array("huo", -17427),
            array("ji", -17417),
            array("jia", -17202),
            array("jian", -17185),
            array("jiang", -16983),
            array("jiao", -16970),
            array("jie", -16942),
            array("jin", -16915),
            array("jing", -16733),
            array("jiong", -16708),
            array("jiu", -16706),
            array("ju", -16689),
            array("juan", -16664),
            array("jue", -16657),
            array("jun", -16647),
            array("ka", -16474),
            array("kai", -16470),
            array("kan", -16465),
            array("kang", -16459),
            array("kao", -16452),
            array("ke", -16448),
            array("ken", -16433),
            array("keng", -16429),
            array("kong", -16427),
            array("kou", -16423),
            array("ku", -16419),
            array("kua", -16412),
            array("kuai", -16407),
            array("kuan", -16403),
            array("kuang", -16401),
            array("kui", -16393),
            array("kun", -16220),
            array("kuo", -16216),
            array("la", -16212),
            array("lai", -16205),
            array("lan", -16202),
            array("lang", -16187),
            array("lao", -16180),
            array("le", -16171),
            array("lei", -16169),
            array("leng", -16158),
            array("li", -16155),
            array("lia", -15959),
            array("lian", -15958),
            array("liang", -15944),
            array("liao", -15933),
            array("lie", -15920),
            array("lin", -15915),
            array("ling", -15903),
            array("liu", -15889),
            array("long", -15878),
            array("lou", -15707),
            array("lu", -15701),
            array("lv", -15681),
            array("luan", -15667),
            array("lue", -15661),
            array("lun", -15659),
            array("luo", -15652),
            array("ma", -15640),
            array("mai", -15631),
            array("man", -15625),
            array("mang", -15454),
            array("mao", -15448),
            array("me", -15436),
            array("mei", -15435),
            array("men", -15419),
            array("meng", -15416),
            array("mi", -15408),
            array("mian", -15394),
            array("miao", -15385),
            array("mie", -15377),
            array("min", -15375),
            array("ming", -15369),
            array("miu", -15363),
            array("mo", -15362),
            array("mou", -15183),
            array("mu", -15180),
            array("na", -15165),
            array("nai", -15158),
            array("nan", -15153),
            array("nang", -15150),
            array("nao", -15149),
            array("ne", -15144),
            array("nei", -15143),
            array("nen", -15141),
            array("neng", -15140),
            array("ni", -15139),
            array("nian", -15128),
            array("niang", -15121),
            array("niao", -15119),
            array("nie", -15117),
            array("nin", -15110),
            array("ning", -15109),
            array("niu", -14941),
            array("nong", -14937),
            array("nu", -14933),
            array("nv", -14930),
            array("nuan", -14929),
            array("nue", -14928),
            array("nuo", -14926),
            array("o", -14922),
            array("ou", -14921),
            array("pa", -14914),
            array("pai", -14908),
            array("pan", -14902),
            array("pang", -14894),
            array("pao", -14889),
            array("pei", -14882),
            array("pen", -14873),
            array("peng", -14871),
            array("pi", -14857),
            array("pian", -14678),
            array("piao", -14674),
            array("pie", -14670),
            array("pin", -14668),
            array("ping", -14663),
            array("po", -14654),
            array("pu", -14645),
            array("qi", -14630),
            array("qia", -14594),
            array("qian", -14429),
            array("qiang", -14407),
            array("qiao", -14399),
            array("qie", -14384),
            array("qin", -14379),
            array("qing", -14368),
            array("qiong", -14355),
            array("qiu", -14353),
            array("qu", -14345),
            array("quan", -14170),
            array("que", -14159),
            array("qun", -14151),
            array("ran", -14149),
            array("rang", -14145),
            array("rao", -14140),
            array("re", -14137),
            array("ren", -14135),
            array("reng", -14125),
            array("ri", -14123),
            array("rong", -14122),
            array("rou", -14112),
            array("ru", -14109),
            array("ruan", -14099),
            array("rui", -14097),
            array("run", -14094),
            array("ruo", -14092),
            array("sa", -14090),
            array("sai", -14087),
            array("san", -14083),
            array("sang", -13917),
            array("sao", -13914),
            array("se", -13910),
            array("sen", -13907),
            array("seng", -13906),
            array("sha", -13905),
            array("shai", -13896),
            array("shan", -13894),
            array("shang", -13878),
            array("shao", -13870),
            array("she", -13859),
            array("shen", -13847),
            array("sheng", -13831),
            array("shi", -13658),
            array("shou", -13611),
            array("shu", -13601),
            array("shua", -13406),
            array("shuai", -13404),
            array("shuan", -13400),
            array("shuang", -13398),
            array("shui", -13395),
            array("shun", -13391),
            array("shuo", -13387),
            array("si", -13383),
            array("song", -13367),
            array("sou", -13359),
            array("su", -13356),
            array("suan", -13343),
            array("sui", -13340),
            array("sun", -13329),
            array("suo", -13326),
            array("ta", -13318),
            array("tai", -13147),
            array("tan", -13138),
            array("tang", -13120),
            array("tao", -13107),
            array("te", -13096),
            array("teng", -13095),
            array("ti", -13091),
            array("tian", -13076),
            array("tiao", -13068),
            array("tie", -13063),
            array("ting", -13060),
            array("tong", -12888),
            array("tou", -12875),
            array("tu", -12871),
            array("tuan", -12860),
            array("tui", -12858),
            array("tun", -12852),
            array("tuo", -12849),
            array("wa", -12838),
            array("wai", -12831),
            array("wan", -12829),
            array("wang", -12812),
            array("wei", -12802),
            array("wen", -12607),
            array("weng", -12597),
            array("wo", -12594),
            array("wu", -12585),
            array("xi", -12556),
            array("xia", -12359),
            array("xian", -12346),
            array("xiang", -12320),
            array("xiao", -12300),
            array("xie", -12120),
            array("xin", -12099),
            array("xing", -12089),
            array("xiong", -12074),
            array("xiu", -12067),
            array("xu", -12058),
            array("xuan", -12039),
            array("xue", -11867),
            array("xun", -11861),
            array("ya", -11847),
            array("yan", -11831),
            array("yang", -11798),
            array("yao", -11781),
            array("ye", -11604),
            array("yi", -11589),
            array("yin", -11536),
            array("ying", -11358),
            array("yo", -11340),
            array("yo", -11340),
            array("yong", -11339),
            array("you", -11324),
            array("yu", -11303),
            array("yuan", -11097),
            array("yue", -11077),
            array("yun", -11067),
            array("za", -11055),
            array("zai", -11052),
            array("zan", -11045),
            array("zang", -11041),
            array("zao", -11038),
            array("ze", -11024),
            array("zei", -11020),
            array("zen", -11019),
            array("zeng", -11018),
            array("zha", -11014),
            array("zhai", -10838),
            array("zhan", -10832),
            array("zhang", -10815),
            array("zhao", -10800),
            array("zhe", -10790),
            array("zhen", -10780),
            array("zheng", -10764),
            array("zhi", -10587),
            array("zhong", -10544),
            array("zhou", -10533),
            array("zhu", -10519),
            array("zhua", -10331),
            array("zhuai", -10329),
            array("zhuan", -10328),
            array("zhuang", -10322),
            array("zhui", -10315),
            array("zhun", -10309),
            array("zhuo", -10307),
            array("zi", -10296),
            array("zong", -10281),
            array("zou", -10274),
            array("zu", -10270),
            array("zuan", -10262),
            array("zui", -10260),
            array("zun", -10256),
            array("zuo", -10254),
        );
    }


    /**
     * 编码转换
     * @param type $from
     * @param type $to
     * @param type $fContents
     * @return type
     */
    protected function iconvStr($from, $to, $fContents) {
        if (is_string($fContents)) {
            if (function_exists('mb_convert_encoding')) {
                return mb_convert_encoding($fContents, $to, $from);
            } else if (function_exists('iconv')) {
                return iconv($from, $to, $fContents);
            } else {
                return $fContents;
            }
        }
    }


    /**
     * 析构函数
     * @access public
     * @return void
     */
    public function __destruct() {
        if (isset($this->lib)) {
            unset($this->lib);
        }
    }


}