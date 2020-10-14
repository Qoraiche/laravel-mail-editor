<script>
tinymce.init({
                selector: "textarea#template_editor",
                menubar: false,
                visual: false,
                height: 600,
                inline_styles: true,
                contextmenu: 'link image imagetools table spellchecker lists prod-image',
                plugins: ["solo-mailtemp-update-product",
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table directionality emoticons template paste fullpage code legacyoutput"
                ],
                content_css: "css/content.css",
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image fullpage | forecolor backcolor emoticons | preview | code",
                fullpage_default_encoding: "UTF-8",
                fullpage_default_doctype: "<!DOCTYPE html>",
                init_instance_callback: function(editor) {
                    setTimeout(function() {
                        editor.execCommand("mceRepaint");
                    }, 5000);
                }
            });
            //Plugin to add item to context menu
            tinymce.PluginManager.add('solo-mailtemp-update-product', function(editor) {
                editor.ui.registry.addMenuItem('prod-image', {
                    icon: 'image',
                    text: 'Update Product',
                    onAction: function() {
                        editor.windowManager.open(productDialogConfig)
                    }
                });

                editor.ui.registry.addContextMenu('prod-image', {
                    update: function(element) {
                        $(tinymce.activeEditor.selection.getNode()).find('.solo-mailtemp-prod-img').removeClass('productSelectedForUpdate');
                        $(element).addClass('productSelectedForUpdate');
                        return !element.src ? '' : 'prod-image';
                    }
                });
            });

            //end plugin
            /* dialog to get product */
            var productDialogConfig = {
                title: 'Update Product With Id',
                body: {
                    type: 'panel',
                    items: [{
                        type: 'input',
                        name: 'productid',
                        label: 'enter product id'
                    }]
                },
                buttons: [{
                        type: 'cancel',
                        name: 'closeButton',
                        text: 'Cancel'
                    },
                    {
                        type: 'submit',
                        name: 'submitButton',
                        id: 'submitTemplateProductId',
                        text: 'submit',
                        primary: true
                    }
                ],
                initialData: {
                    productid: '',
                    isdog: false
                },
                onSubmit: function(api) {
                    var data = api.getData();
                    var productid = data.productid;
                    if(!productid){
                        alert('enter product id');
                        return;
                    }
                    $.ajax({
                        method: "GET",
                        url: "<?php echo e(route('getTemplateProduct')); ?>",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            productid: productid,
                        }

                    }).done(function(response) {
                        if(typeof response !== undefined && response.status == 'success' ){
                            var ele = $(tinymce.activeEditor.selection.select(tinymce.activeEditor.dom.select('img.productSelectedForUpdate')[0]));
                            ele.attr('src',response.product_image); 
                            ele.closest('.info-block').find('.solo-mailtemp-prod-title').html(response.productName);
                            ele.closest('.info-block').find('.solo-mailtemp-prod-shortdesc').html(response.short_description);
                            ele.closest('.info-block').find('.solo-mailtemp-prod-price').html(response.price);
                            ele.closest('.info-block').find('.solo-mailtemp-prod-url').attr('href',response.product_url);
                            ele.removeClass('productSelectedForUpdate');
                        }else
                        {
                            alert(response.message);
                        }
                    });

                    api.close();
                }
            };
            //end dialog
            </script>
<footer class="text-right mt-4" style="font-size: 14px;">
      <div class="text-muted">
          <p>&copy; 2019 - <a href="https://maileclipse.io/" target="_blank">MailEclipse.io</a> v1.3</p>
			<a class="github-button" href="https://github.com/qoraiche/laravel-mail-editor/issues" data-icon="octicon-issue-opened" aria-label="Issue qoraiche/laravel-mail-editor on GitHub">Issue</a>

			<a class="github-button" href="https://github.com/qoraiche/laravel-mail-editor" data-icon="octicon-star" data-show-count="true" aria-label="Star qoraiche/laravel-mail-editor on GitHub">Star</a>

      </div>      
      
 </footer>
