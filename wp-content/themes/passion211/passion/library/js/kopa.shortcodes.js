var kopaContainerType = 'tab';

(function() {
    tinymce.PluginManager.add('kopa_shortcode', function(editor) {
        var grid = new Array(12);
        grid[0] = '[col col=12]TEXT[/col]<br/>';
        grid[1] = '[col col=6]TEXT[/col]<br/>';
        grid[1] += '[col col=6]TEXT[/col]<br/>';
        grid[2] = '[col col=4]TEXT[/col]<br/>';
        grid[2] += '[col col=4]TEXT[/col]<br/>';
        grid[2] += '[col col=4]TEXT[/col]<br/>';
        grid[3] = '[col col=4]TEXT[/col]<br/>';
        grid[3] += '[col col=8]TEXT[/col]<br/>';
        grid[4] = '[col col=3]TEXT[/col]<br/>';
        grid[4] += '[col col=6]TEXT[/col]<br/>';
        grid[4] += '[col col=3]TEXT[/col]<br/>';
        grid[5] = '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[5] += '[col col=3]TEXT[/col]<br/>';
        grid[6] = '[col col=3]TEXT[/col]<br/>';
        grid[6] += '[col col=9]TEXT[/col]<br/>';
        grid[7] = '[col col=2]TEXT[/col]<br/>';
        grid[7] += '[col col=8]TEXT[/col]<br/>';
        grid[7] += '[col col=2]TEXT[/col]<br/>';
        grid[8] = '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=2]TEXT[/col]<br/>';
        grid[8] += '[col col=6]TEXT[/col]<br/>';
        grid[9] = '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[9] += '[col col=2]TEXT[/col]<br/>';
        grid[10] = '[col col=8]TEXT[/col]<br/>';
        grid[10] += '[col col=4]TEXT[/col]<br/>';
        grid[11] = '[col col=10]TEXT[/col]<br/>';
        grid[11] += '[col col=2]TEXT[/col]<br/>';

        var grid_icons = new Array(
                '11',
                '12_12',
                '13_13_13',
                '13_23',
                '14_12_14',
                '14_14_14_14',
                '14_34',
                '16_46_16',
                '16_16_16_12',
                '16_16_16_16_16_16',
                '23_13',
                '56_16');

        editor.addButton('kopa_shortcode', {
            type: 'splitbutton',
            title: 'shortcode',
            icon: 'kopa-shortcode',
            menu: [
                {
                    text: kopa_variable.i18n.grid,
                    icon: 'grid',
                    menu: [
                        {
                            text: '1/1',
                            icon: grid_icons[0],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[0] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/2 - 1/2',
                            icon: grid_icons[1],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[1] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/3 - 1/3 - 1/3',
                            icon: grid_icons[2],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[2] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/3 - 2/3',
                            icon: grid_icons[3],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[3] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 1/2 - 1/4',
                            icon: grid_icons[4],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[4] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 1/4 - 1/4 - 1/4',
                            icon: grid_icons[5],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[5] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/4 - 3/4',
                            icon: grid_icons[6],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[6] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 4/6 - 1/6',
                            icon: grid_icons[7],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[7] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 1/6 - 1/6 - 1/2',
                            icon: grid_icons[8],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[8] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6',
                            icon: grid_icons[9],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[9] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '2/3 - 1/3',
                            icon: grid_icons[10],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[10] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        },
                        {
                            text: '5/6 - 1/6',
                            icon: grid_icons[11],
                            onclick: function() {
                                shortcode = '[row]<br/>' + grid[11] + '[/row]<br/>';
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.container,
                    icon: 'container',
                    menu: [
                        {
                            text: 'Tabs',
                            icon: 'tabs',
                            onclick: function() {
                                kopaContainerType = 'tab';

                                jQuery.colorbox({
                                    inline: true,
                                    top: 50,
                                    innerWidth: '80%',
                                    maxWidth: '100%',
                                    overlayClose: false,
                                    href: "#kopa_container_builder"
                                });
                            }
                        },
                        {
                            text: 'Accordion',
                            icon: 'accordion',
                            onclick: function() {
                                kopaContainerType = 'accordion';

                                jQuery.colorbox({
                                    inline: true,
                                    top: 50,
                                    innerWidth: '80%',
                                    maxWidth: '100%',
                                    overlayClose: false,
                                    href: "#kopa_container_builder"
                                });
                            }
                        },
                        {
                            text: 'Toggle',
                            icon: 'accordion',
                            onclick: function() {
                                kopaContainerType = 'toggle';

                                jQuery.colorbox({
                                    inline: true,
                                    top: 50,
                                    innerWidth: '80%',
                                    maxWidth: '100%',
                                    overlayClose: false,
                                    href: "#kopa_container_builder"
                                });
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.video,
                    icon: 'video',
                    menu: [
                        {
                            text: 'Youtube',
                            icon: 'youtube',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[youtube url="http://www.youtube.com/watch?v=1iIZeIy7TqM"]');
                            }
                        },
                        {
                            text: 'Vimeo',
                            icon: 'vimeo',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[vimeo url="http://vimeo.com/7449107"]');
                            }
                        },
                        {
                            text: 'Mp4',
                            icon: 'mp4',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[video mp4="http://link-to-file.mp4"][/video]');
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.dropcap,
                    icon: 'dropcap',
                    menu: [
                        {
                            text: kopa_variable.i18n.square,
                            icon: 'square',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap class="kp-dropcap"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                            }
                        },
                        {
                            text: kopa_variable.i18n.circle,
                            icon: 'circle',
                            onclick: function() {
                                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap class="kp-dropcap radius"]' + tinyMCE.activeEditor.selection.getContent() + '[/dropcap]');
                            }
                        }
                    ]
                },
                {
                    text: kopa_variable.i18n.caption,
                    icon: 'caption',
                    onclick: function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[kp_caption]' + tinyMCE.activeEditor.selection.getContent() + '[/kp_caption]');
                    }
                },
                {
                    text: kopa_variable.i18n.button,
                    icon: 'button',
                    onclick: function() {
                        jQuery.colorbox({
                            inline: true,
                            innerWidth: '80%',
                            top: 50,
                            maxWidth: '100%',
                            overlayClose: false,
                            href: "#kopa_button_builder"
                        });
                    }
                },
                {
                    text: kopa_variable.i18n.share_this_post,
                    icon: 'share',
                    onclick: function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[share_this_post]');
                    }
                },
                {
                    text: kopa_variable.i18n.contact_form,
                    icon: 'mail',
                    onclick: function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[contact_form]');
                    }
                }
            ]
        });
    });
})();


var KopaShortcode = {
    add_container_element: function(event, wrap) {
        event.preventDefault();
        var last_item = wrap.find('.kopa_shortcode_container_element').last();
        var clone = last_item.clone();
        clone.find('textarea').text('');
        clone.insertAfter(last_item);
        jQuery.colorbox.resize();
    },
    remove_container_element: function(event, obj) {
        event.preventDefault();
        var items = obj.parents('.kopa_shortcode_inline').find('.kopa_shortcode_container_element');
        if (items.length > 1) {
            obj.parents('.kopa_shortcode_container_element').remove();
        } else {
            items.find('textarea').val('');
        }

        jQuery.colorbox.resize();
    },
    create_button: function(event, type) {
        event.preventDefault();

        if ('button' === type) {
            var text = jQuery('.ks_button_text').val();
            var link = jQuery('.ks_button_link').val();
            var link_target = jQuery('.ks_button_link_target option:selected').val();
            var type = jQuery('.ks_button_type:checked').val();

            if ('' !== jQuery.trim(text)) {
                var shortcode = '[button class="' + type + '" link="' + link + '" target="' + link_target + '"]' + text + '[/button]';
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
                jQuery.colorbox.close();

                jQuery('.ks_button_text').val('');
                jQuery('.ks_button_link').val('');
                jQuery('.ks_button_link_target option').first().attr('selected', 'selected');
                jQuery('.ks_button_type').first().attr('checked', 'checked');
            } else {
                alert('Please enter button text.');
            }
        } else if ('container' === type) {
            kopaContainerType = ('' !== kopaContainerType) ? kopaContainerType : 'tab';

            var elements = jQuery('.kopa_shortcode_container_element');

            var shortcode = '[' + kopaContainerType + 's]<br/>';
            jQuery.each(elements, function() {
                title = jQuery(this).find('.kopa_container_element_title').val();
                content = jQuery(this).find('.kopa_container_element_content').val();

                shortcode += '[' + kopaContainerType + ' title="' + title + '"]<br/>';
                shortcode += content + '<br/>';
                shortcode += '[/' + kopaContainerType + ']<br/>';
            });
            shortcode += '[/' + kopaContainerType + 's]<br/>';


            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            jQuery.colorbox.close();
        }

    }
};
