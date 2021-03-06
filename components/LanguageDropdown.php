<?php


namespace app\components;

use Yii;

class LanguageDropdown
{
    public $items;
    private static $_labels;

    public function getLanguageItems()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;

        array_unshift($params, '/' . $route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2) === '-*';
            if (
                $language === $appLanguage ||
                // Also check for wildcard language
                $isWildcard && substr($appLanguage, 0, 2) === substr($language, 0, 2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildcard) {
                $language = substr($language, 0, 2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => self::label($language),
                'url' => $params,
            ];
        }

        return $this->items;
    }

    public static function label($code)
    {
        if (self::$_labels === null) {
            self::$_labels = [
                'ru' => Yii::t('language', 'Рус'),
                'eng' => Yii::t('language', 'Eng'),
            ];
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }

    public function getCurrentLanguageItem()
    {
        return self::label(Yii::$app->language);
    }
}