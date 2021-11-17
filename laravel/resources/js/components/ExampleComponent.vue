<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                        <img src="images/logo.png"/>
                    </a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse flex-row-reverse">
                        <form class="form-inline my-2 my-lg-0">
                            <a-input-search class="header-search" style="width: 200px" />
                        </form>
                    </div>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="header-dot"></div>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight header-title">Phước đất nhà xưởng</div>
                    <div class="p-2 bd-highlight">
                        <ul class="header-nav" v-if="view">
                            <template v-if="login">
                                <li>
                                    Thoat
                                    <!--<a @click="onLogout"> Thoát </a>-->
                                </li>
                            </template>
                            <template v-else>
                                <li>
                                    <a href="/dang-ky"> Đăng ký </a>
                                </li>
                                <li>
                                    <a href="/dang-nhap"> Đăng nhập </a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            login: {
                type: Boolean,
                default: () => false,
            },
            view: {
                type: Boolean,
                default: () => true,
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style lang="scss" scoped>
    .header-search {
        .ant-input-affix-wrapper {
            width: 300px;
            font-size: 20px;
            input {
                height: 40px;
            }
        }
        .ant-input-search-icon {
            svg {
                color: #000;
                font-size: 20px;
            }
        }
    }
    .header-dot {
        border-bottom: 2px solid #00a88e;
        width: 200px;
        margin: 1.5rem 1rem;
    }
    .header-title {
        color: #ffffff;
        font-size: 100px;
        max-width: 600px;
        line-height: 1;
        text-transform: uppercase;
        font-weight: 245;
    }
    .header-nav {
        list-style: none;
        font-size: 20px;
        font-weight: 200;
        line-height: 180%;

        li {
            border-bottom: 2px solid #00a88e;

            a {
                color: #ffffff;
                &:hover {
                    color: #ffffff;
                }
            }
        }
    }
</style>
