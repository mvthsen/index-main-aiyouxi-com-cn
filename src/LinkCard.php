<?php

/**
 * 渲染爱游戏相关链接卡片的辅助函数
 * 输出经过 HTML 转义的卡片片段
 */
class LinkCard
{
    /**
     * 卡片配置数据
     * @var array
     */
    private static $cardData = [
        'title' => '爱游戏',
        'description' => '发现更多精彩游戏内容，尽在爱游戏平台。',
        'url' => 'https://index-main-aiyouxi.com.cn',
        'icon' => '🎮',
    ];

    /**
     * 渲染单张链接卡片
     *
     * @param array $data 卡片数据，包含 title, description, url, icon
     * @return string 生成的 HTML 字符串
     */
    public static function render(array $data = []): string
    {
        // 合并默认数据与传入数据
        $merged = array_merge(self::$cardData, $data);

        // 转义所有字符串字段
        $safeTitle = htmlspecialchars($merged['title'], ENT_QUOTES, 'UTF-8');
        $safeDesc = htmlspecialchars($merged['description'], ENT_QUOTES, 'UTF-8');
        $safeUrl = htmlspecialchars($merged['url'], ENT_QUOTES, 'UTF-8');
        $safeIcon = htmlspecialchars($merged['icon'], ENT_QUOTES, 'UTF-8');

        // 构建卡片 HTML
        $html = '<div class="link-card">' . "\n";
        $html .= '    <a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        <span class="card-icon">' . $safeIcon . '</span>' . "\n";
        $html .= '        <div class="card-content">' . "\n";
        $html .= '            <strong>' . $safeTitle . '</strong>' . "\n";
        $html .= '            <p>' . $safeDesc . '</p>' . "\n";
        $html .= '        </div>' . "\n";
        $html .= '    </a>' . "\n";
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * 渲染一组链接卡片
     *
     * @param array $cards 卡片数据数组
     * @return string 拼接后的 HTML
     */
    public static function renderMultiple(array $cards): string
    {
        $output = '';
        foreach ($cards as $card) {
            $output .= self::render($card);
        }
        return $output;
    }
}

// 示例用法（当直接运行此文件时）
if (realpath($_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    // 单卡片展示
    echo LinkCard::render();

    // 多卡片展示示例
    $moreCards = [
        [
            'title' => '爱游戏 - 热门推荐',
            'description' => '每天更新热门游戏榜单。',
            'url' => 'https://index-main-aiyouxi.com.cn/hot',
            'icon' => '🔥',
        ],
        [
            'title' => '爱游戏 - 新游预约',
            'description' => '第一时间预约最新游戏。',
            'url' => 'https://index-main-aiyouxi.com.cn/new',
            'icon' => '🆕',
        ],
    ];
    echo "\n<!-- 多卡片区域 -->\n";
    echo LinkCard::renderMultiple($moreCards);
}