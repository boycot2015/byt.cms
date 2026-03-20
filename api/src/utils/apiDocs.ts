// API文档配置
export const apiDocs = {
  openapi: "3.0.0",
  info: {
    title: "Cloudflare Workers CMS API",
    description: "基于Cloudflare Workers的CMS API文档",
    version: "1.0.0"
  },
  servers: [
    {
      url: "https://cms-api.boycot.dpdns.org/api",
      description: "生产环境"
    },
    {
      url: "http://localhost:8787/api",
      description: "本地开发环境"
    }
  ],
  paths: {
    "/categories": {
      get: {
        summary: "获取所有分类",
        description: "获取系统中所有分类的列表，支持排序和状态筛选",
        parameters: [
          {
            in: "query",
            name: "sortBy",
            schema: {
              type: "string",
              enum: ["order", "createTime", "name"],
              default: "order"
            },
            description: "排序字段"
          },
          {
            in: "query",
            name: "sortOrder",
            schema: {
              type: "string",
              enum: ["asc", "desc"],
              default: "desc"
            },
            description: "排序方向"
          },
          {
            in: "query",
            name: "status",
            schema: {
              type: "string",
              enum: ["active", "inactive"]
            },
            description: "分类状态筛选"
          }
        ],
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "array",
                  items: {
                    type: "object",
                    properties: {
                      id: { type: "string" },
                      name: { type: "string" },
                      desc: { type: "string" },
                      order: { type: "number" },
                      status: { type: "string", enum: ["active", "inactive"] },
                      createTime: { type: "string" }
                    }
                  }
                }
              }
            }
          }
        }
      },
      post: {
        summary: "创建分类",
        description: "创建新的分类",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  name: {
                    type: "string",
                    description: "分类名称"
                  },
                  desc: {
                    type: "string",
                    description: "分类描述"
                  },
                  order: {
                    type: "number",
                    description: "分类排序"
                  },
                  status: {
                    type: "string",
                    enum: ["active", "inactive"],
                    default: "active",
                    description: "分类状态"
                  }
                },
                required: ["name"]
              }
            }
          }
        },
        responses: {
          "201": {
            description: "创建成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    name: { type: "string" },
                    desc: { type: "string" },
                    order: { type: "number" },
                    status: { type: "string", enum: ["active", "inactive"] },
                    createTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/categories/{id}": {
      delete: {
        summary: "删除分类",
        description: "根据ID删除分类",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "分类ID"
          }
        ],
        responses: {
          "200": {
            description: "删除成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/categories/{id}/status": {
      put: {
        summary: "更新分类状态",
        description: "根据ID更新分类的启用/禁用状态",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "分类ID"
          }
        ],
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  status: {
                    type: "string",
                    enum: ["active", "inactive"],
                    description: "分类状态"
                  }
                },
                required: ["status"]
              }
            }
          }
        },
        responses: {
          "200": {
            description: "更新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/tags": {
      get: {
        summary: "获取所有标签",
        description: "获取系统中所有标签的列表",
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "array",
                  items: {
                    type: "object",
                    properties: {
                      id: { type: "string" },
                      name: { type: "string" },
                      createTime: { type: "string" }
                    }
                  }
                }
              }
            }
          }
        }
      },
      post: {
        summary: "创建标签",
        description: "创建新的标签",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  name: {
                    type: "string",
                    description: "标签名称"
                  }
                },
                required: ["name"]
              }
            }
          }
        },
        responses: {
          "201": {
            description: "创建成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    name: { type: "string" },
                    createTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/tags/{id}": {
      delete: {
        summary: "删除标签",
        description: "根据ID删除标签",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "标签ID"
          }
        ],
        responses: {
          "200": {
            description: "删除成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/videos": {
      get: {
        summary: "获取视频列表",
        description: "获取视频列表，支持分页和筛选，只查询启用分类的视频",
        parameters: [
          {
            in: "query",
            name: "id",
            schema: {
              type: "string"
            },
            description: "视频ID，单个查询时使用"
          },
          {
            in: "query",
            name: "category",
            schema: {
              type: "string"
            },
            description: "分类ID"
          },
          {
            in: "query",
            name: "tag",
            schema: {
              type: "string"
            },
            description: "标签ID"
          },
          {
            in: "query",
            name: "source",
            schema: {
              type: "string"
            },
            description: "视频来源"
          },
          {
            in: "query",
            name: "search",
            schema: {
              type: "string"
            },
            description: "搜索关键词"
          },
          {
            in: "query",
            name: "recommended",
            schema: {
              type: "boolean"
            },
            description: "是否推荐"
          },
          {
            in: "query",
            name: "page",
            schema: {
              type: "number",
              default: 1
            },
            description: "页码"
          },
          {
            in: "query",
            name: "pageSize",
            schema: {
              type: "number",
              default: 10
            },
            description: "每页数量"
          }
        ],
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  oneOf: [
                    {
                      type: "object",
                      properties: {
                        list: {
                          type: "array",
                          items: {
                            type: "object",
                            properties: {
                              id: { type: "string" },
                              title: { type: "string" },
                              subTitle: { type: "string" },
                              desc: { type: "string" },
                              cover: { type: "string" },
                              banner: { type: "string" },
                              category: { type: "string" },
                              categoryId: { type: "string" },
                              actors: { type: "array", items: { type: "string" } },
                              director: { type: "string" },
                              writer: { type: "string" },
                              recommended: { type: "boolean" },
                              tags: {
                                type: "array",
                                items: {
                                  type: "object",
                                  properties: {
                                    id: { type: "string" },
                                    name: { type: "string" },
                                    createTime: { type: "string" }
                                  }
                                }
                              },
                              sources: {
                                type: "array",
                                items: {
                                  type: "object",
                                  properties: {
                                    id: { type: "string" },
                                    videoId: { type: "string" },
                                    source: { type: "string" },
                                    url: { type: "string" },
                                    urls: {
                                      type: "array",
                                      items: {
                                        type: "object",
                                        properties: {
                                          label: { type: "string" },
                                          url: { type: "string" }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        },
                        total: { type: "number" },
                        page: { type: "number" },
                        pageSize: { type: "number" }
                      }
                    },
                    {
                      type: "object",
                      properties: {
                        id: { type: "string" },
                        title: { type: "string" },
                        subTitle: { type: "string" },
                        desc: { type: "string" },
                        cover: { type: "string" },
                        banner: { type: "string" },
                        category: { type: "string" },
                        categoryId: { type: "string" },
                        actors: { type: "array", items: { type: "string" } },
                        director: { type: "string" },
                        writer: { type: "string" },
                        recommended: { type: "boolean" },
                        tags: {
                          type: "array",
                          items: {
                            type: "object",
                            properties: {
                              id: { type: "string" },
                              name: { type: "string" },
                              createTime: { type: "string" }
                            }
                          }
                        },
                        sources: {
                          type: "array",
                          items: {
                            type: "object",
                            properties: {
                              id: { type: "string" },
                              videoId: { type: "string" },
                              source: { type: "string" },
                              url: { type: "string" },
                              urls: {
                                type: "array",
                                items: {
                                  type: "object",
                                  properties: {
                                    label: { type: "string" },
                                    url: { type: "string" }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  ]
                }
              }
            }
          }
        }
      }
    },
    "/videos/{id}": {
      delete: {
        summary: "删除视频",
        description: "根据ID删除视频",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "视频ID"
          }
        ],
        responses: {
          "200": {
            description: "删除成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/videos/recommended": {
      get: {
        summary: "获取推荐视频",
        description: "获取推荐视频列表，只查询启用分类的视频",
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "array",
                  items: {
                    type: "object",
                    properties: {
                      id: { type: "string" },
                      title: { type: "string" },
                      subTitle: { type: "string" },
                      desc: { type: "string" },
                      cover: { type: "string" },
                      banner: { type: "string" },
                      category: { type: "string" },
                      categoryId: { type: "string" },
                      actors: { type: "array", items: { type: "string" } },
                      director: { type: "string" },
                      writer: { type: "string" },
                      recommended: { type: "boolean" },
                      tags: {
                        type: "array",
                        items: {
                          type: "object",
                          properties: {
                            id: { type: "string" },
                            name: { type: "string" },
                            createTime: { type: "string" }
                          }
                        }
                      },
                      sources: {
                        type: "array",
                        items: {
                          type: "object",
                          properties: {
                            id: { type: "string" },
                            videoId: { type: "string" },
                            source: { type: "string" },
                            url: { type: "string" },
                            urls: {
                              type: "array",
                              items: {
                                type: "object",
                                properties: {
                                  label: { type: "string" },
                                  url: { type: "string" }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/videos/recommended/{id}": {
      post: {
        summary: "更新视频推荐状态",
        description: "更新视频的推荐状态",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "视频ID"
          }
        ],
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  recommended: {
                    type: "boolean",
                    description: "是否推荐"
                  }
                },
                required: ["recommended"]
              }
            }
          }
        },
        responses: {
          "200": {
            description: "更新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/comments": {
      get: {
        summary: "获取评论列表",
        description: "获取评论列表，支持分页和筛选",
        parameters: [
          {
            in: "query",
            name: "videoId",
            schema: {
              type: "string"
            },
            description: "视频ID"
          },
          {
            in: "query",
            name: "episodeId",
            schema: {
              type: "string"
            },
            description: "集数ID"
          },
          {
            in: "query",
            name: "page",
            schema: {
              type: "number",
              default: 1
            },
            description: "页码"
          },
          {
            in: "query",
            name: "pageSize",
            schema: {
              type: "number",
              default: 20
            },
            description: "每页数量"
          }
        ],
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    list: {
                      type: "array",
                      items: {
                        type: "object",
                        properties: {
                          id: { type: "string" },
                          videoId: { type: "string" },
                          episodeId: { type: "string" },
                          userId: { type: "string" },
                          content: { type: "string" },
                          parentId: { type: "string" },
                          likes: { type: "number" },
                          status: { type: "string" },
                          createTime: { type: "string" },
                          updateTime: { type: "string" },
                          replies: {
                            type: "array",
                            items: {
                              type: "object",
                              properties: {
                                id: { type: "string" },
                                videoId: { type: "string" },
                                episodeId: { type: "string" },
                                userId: { type: "string" },
                                content: { type: "string" },
                                parentId: { type: "string" },
                                likes: { type: "number" },
                                status: { type: "string" },
                                createTime: { type: "string" },
                                updateTime: { type: "string" }
                              }
                            }
                          }
                        }
                      }
                    },
                    total: { type: "number" },
                    page: { type: "number" },
                    pageSize: { type: "number" }
                  }
                }
              }
            }
          }
        }
      },
      post: {
        summary: "创建评论",
        description: "创建新的评论",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  videoId: {
                    type: "string",
                    description: "视频ID"
                  },
                  episodeId: {
                    type: "string",
                    description: "集数ID"
                  },
                  userId: {
                    type: "string",
                    description: "用户ID"
                  },
                  content: {
                    type: "string",
                    description: "评论内容"
                  },
                  parentId: {
                    type: "string",
                    description: "父评论ID，回复时使用"
                  },
                  currentTime: {
                    type: "number",
                    description: "评论时的视频播放时间"
                  }
                },
                required: ["videoId", "userId", "content"]
              }
            }
          }
        },
        responses: {
          "201": {
            description: "创建成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    videoId: { type: "string" },
                    episodeId: { type: "string" },
                    userId: { type: "string" },
                    content: { type: "string" },
                    parentId: { type: "string" },
                    likes: { type: "number" },
                    status: { type: "string" },
                    createTime: { type: "string" },
                    updateTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/comments/{id}/like": {
      post: {
        summary: "点赞评论",
        description: "为评论点赞",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "评论ID"
          }
        ],
        responses: {
          "200": {
            description: "点赞成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    likes: {
                      type: "number"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/comments/{id}": {
      delete: {
        summary: "删除评论",
        description: "根据ID删除评论（软删除）",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "评论ID"
          }
        ],
        responses: {
          "200": {
            description: "删除成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/users/login": {
      post: {
        summary: "用户登录",
        description: "用户登录接口",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  username: {
                    type: "string",
                    description: "用户名"
                  },
                  password: {
                    type: "string",
                    description: "密码"
                  }
                },
                required: ["username", "password"]
              }
            }
          }
        },
        responses: {
          "200": {
            description: "登录成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    user: {
                      type: "object",
                      properties: {
                        id: { type: "string" },
                        username: { type: "string" },
                        nickname: { type: "string" },
                        avatar: { type: "string" },
                        role: { type: "string" },
                        status: { type: "string" },
                        token: { type: "string" },
                        createTime: { type: "string" },
                        updateTime: { type: "string" }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/users/register": {
      post: {
        summary: "用户注册",
        description: "用户注册接口",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  username: {
                    type: "string",
                    description: "用户名"
                  },
                  password: {
                    type: "string",
                    description: "密码"
                  },
                  nickname: {
                    type: "string",
                    description: "昵称"
                  }
                },
                required: ["username", "password"]
              }
            }
          }
        },
        responses: {
          "201": {
            description: "注册成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    username: { type: "string" },
                    nickname: { type: "string" },
                    avatar: { type: "string" },
                    role: { type: "string" },
                    status: { type: "string" },
                    createTime: { type: "string" },
                    updateTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/users": {
      get: {
        summary: "获取用户列表",
        description: "获取系统中所有用户的列表",
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "array",
                  items: {
                    type: "object",
                    properties: {
                      id: { type: "string" },
                      username: { type: "string" },
                      nickname: { type: "string" },
                      avatar: { type: "string" },
                      role: { type: "string" },
                      status: { type: "string" },
                      createTime: { type: "string" },
                      updateTime: { type: "string" }
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/users/{id}": {
      post: {
        summary: "更新用户",
        description: "根据ID更新用户信息",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "用户ID"
          }
        ],
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  nickname: {
                    type: "string",
                    description: "昵称"
                  },
                  avatar: {
                    type: "string",
                    description: "头像"
                  },
                  role: {
                    type: "string",
                    description: "角色"
                  },
                  status: {
                    type: "string",
                    description: "状态"
                  },
                  password: {
                    type: "string",
                    description: "密码"
                  }
                }
              }
            }
          }
        },
        responses: {
          "200": {
            description: "更新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    username: { type: "string" },
                    nickname: { type: "string" },
                    avatar: { type: "string" },
                    role: { type: "string" },
                    status: { type: "string" },
                    createTime: { type: "string" },
                    updateTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      },
      delete: {
        summary: "删除用户",
        description: "根据ID删除用户",
        parameters: [
          {
            in: "path",
            name: "id",
            required: true,
            schema: {
              type: "string"
            },
            description: "用户ID"
          }
        ],
        responses: {
          "200": {
            description: "删除成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/site-config": {
      get: {
        summary: "获取网站配置",
        description: "获取网站配置信息",
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    userId: { type: "string" },
                    logo: { type: "string" },
                    title: { type: "string" },
                    bannerCount: { type: "number" },
                    categoryIds: { type: "array", items: { type: "string" } },
                    categoryCols: { type: "number" },
                    categoryRows: { type: "number" },
                    rankingCategoryIds: { type: "array", items: { type: "string" } },
                    rankingCount: { type: "number" },
                    recommendTitle: { type: "string" },
                    links: {
                      type: "array",
                      items: {
                        type: "object",
                        properties: {
                          name: { type: "string" },
                          url: { type: "string" }
                        }
                      }
                    },
                    createTime: { type: "string" },
                    updateTime: { type: "string" }
                  }
                }
              }
            }
          }
        }
      },
      post: {
        summary: "更新网站配置",
        description: "更新网站配置信息",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "object",
                properties: {
                  userId: {
                    type: "string",
                    description: "用户ID"
                  },
                  logo: {
                    type: "string",
                    description: "网站Logo"
                  },
                  title: {
                    type: "string",
                    description: "网站标题"
                  },
                  bannerCount: {
                    type: "number",
                    description: "Banner展示数量"
                  },
                  categoryIds: {
                    type: "array",
                    items: {
                      type: "string"
                    },
                    description: "首页分类展示的分类ID"
                  },
                  categoryCols: {
                    type: "number",
                    description: "分类一行展示数量"
                  },
                  categoryRows: {
                    type: "number",
                    description: "分类展示行数"
                  },
                  rankingCategoryIds: {
                    type: "array",
                    items: {
                      type: "string"
                    },
                    description: "首页排行展示的分类ID"
                  },
                  rankingCount: {
                    type: "number",
                    description: "排行展示数量"
                  },
                  recommendTitle: {
                    type: "string",
                    description: "首页推荐标题"
                  },
                  links: {
                    type: "array",
                    items: {
                      type: "object",
                      properties: {
                        name: { type: "string" },
                        url: { type: "string" }
                      }
                    },
                    description: "友情链接"
                  }
                },
                required: ["userId"]
              }
            }
          }
        },
        responses: {
          "200": {
            description: "更新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    message: {
                      type: "string"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/upload/image": {
      post: {
        summary: "上传图片",
        description: "上传图片文件",
        requestBody: {
          required: true,
          content: {
            "multipart/form-data": {
              schema: {
                type: "object",
                properties: {
                  file: {
                    type: "string",
                    format: "binary",
                    description: "图片文件"
                  }
                },
                required: ["file"]
              }
            }
          }
        },
        responses: {
          "200": {
            description: "上传成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    data: {
                      type: "object",
                      properties: {
                        url: {
                          type: "string"
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/video-sources": {
      get: {
        summary: "获取视频源配置",
        description: "获取所有视频源配置",
        responses: {
          "200": {
            description: "成功",
            content: {
              "application/json": {
                schema: {
                  type: "array",
                  items: {
                    type: "object",
                    properties: {
                      id: { type: "string" },
                      name: { type: "string" },
                      type: { type: "string" },
                      cron: { type: "string" },
                      enabled: { type: "boolean" },
                      path: { type: "string" },
                      categoryId: { type: "string" },
                      category: { type: "number" },
                      tags: { type: "array", items: { type: "string" } },
                      action: { type: "string" }
                    }
                  }
                }
              }
            }
          }
        }
      },
      post: {
        summary: "视频源配置管理",
        description: "更新视频源配置",
        requestBody: {
          required: true,
          content: {
            "application/json": {
              schema: {
                type: "array",
                items: {
                  type: "object",
                  properties: {
                    id: { type: "string" },
                    name: { type: "string" },
                    type: { type: "string" },
                    cron: { type: "string" },
                    enabled: { type: "boolean" },
                    path: { type: "string" },
                    categoryId: { type: "string" },
                    category: { type: "number" },
                    tags: { type: "array", items: { type: "string" } },
                    action: { type: "string" }
                  }
                }
              }
            }
          }
        },
        responses: {
          "200": {
            description: "更新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/video-source-data/{type}": {
      get: {
        summary: "手动抓取视频源数据",
        description: "手动抓取指定视频源的数据",
        parameters: [
          {
            in: "path",
            name: "type",
            required: true,
            schema: {
              type: "string"
            },
            description: "视频源类型"
          },
          {
            in: "query",
            name: "action",
            schema: {
              type: "string"
            },
            description: "操作类型"
          },
          {
            in: "query",
            name: "cid",
            schema: {
              type: "string"
            },
            description: "分类ID"
          }
        ],
        responses: {
          "200": {
            description: "抓取成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    code: {
                      type: "number"
                    },
                    count: {
                      type: "number"
                    },
                    page: {
                      type: "number"
                    },
                    data: {
                      type: "object"
                    }
                  }
                }
              }
            }
          }
        }
      }
    },
    "/video-fetch-recommend": {
      get: {
        summary: "刷新推荐视频",
        description: "刷新推荐视频数据",
        responses: {
          "200": {
            description: "刷新成功",
            content: {
              "application/json": {
                schema: {
                  type: "object",
                  properties: {
                    success: {
                      type: "boolean"
                    },
                    data: {
                      type: "array",
                      items: {
                        type: "object"
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
};